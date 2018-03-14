<?php

namespace App\Listeners;

use App\Events\PostViewEvent;
use Illuminate\Support\Facades\Redis;
use App\Model\Post;

class PostEventListener
{

    /**
     * 一个帖子的最大访问数,再刷新数据库
     */
    const postViewLimit = 2;

    /**
     * 同一用户浏览同一个帖子的过期时间
     */
    const ipExpireSec = 10;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * 监听用户浏览事件
     * @param  PostViewEvent  $event
     * @return void
     */
    public function handle(PostViewEvent $event)
    {
        $post = $event->post;
        $ip = $event->ip;
        $id = $post->id;
        //首先判断下ipExpireSec = 300秒时间内,同一IP访问多次,仅仅作为1次访问量
        if ($this->ipViewLimit($id,$ip)){
            //一个IP在300秒时间内访问第一次时,刷新下该篇post的浏览量
            $this->updateCacheViewCount($id, $ip);
        }

    }

    /**
     * 限制同一IP一段时间内得访问,防止增加无效浏览次数
     */
    public function ipViewLimit($id,$ip){
        $ipPostViewKey = 'post:ip:limit:'.$id;
        //Redis命令SISMEMBER检查集合类型Set中有没有该键,Set集合类型中值都是唯一
        $existsInRedisSet = Redis::command('SISMEMBER',[$ipPostViewKey,$ip]);
        //如果集合中不存在这个建 那么新建一个并设置过期时间
        if (!$existsInRedisSet){
            //SADD,集合类型指令,向ipPostViewKey键中加一个值ip
            Redis::command('SADD', [$ipPostViewKey, $ip]);
            //并给该键设置生命时间,这里设置300秒,300秒后同一IP访问就当做是新的浏览量了
            Redis::command('EXPIRE', [$ipPostViewKey, self::ipExpireSec]);
            return true;
        }
        return false;
    }

    /**
     * 达到要求,更新数据库的浏览量
     */
    public function updateModelViewCount($id,$count)
    {
        //访问量达到300,再进行一次SQL更新
        $post = Post::find($id);
        $post->view_count += $count;
        $post->save();
    }

    /**
     * 不同用户访问,更新缓存中浏览次数
     */
    public function updateCacheViewCount($id,$ip)
    {
        $cacheKey = 'post:view:'.$id;
        //这里以Redis哈希类型存储键,就和数组类似,$cacheKey就类似数组名 如果这个key存在
        if(Redis::command('HEXISTS', [$cacheKey, $ip])){
            //哈希类型指令HINCRBY,就是给$cacheKey[$ip]加上一个值,这里一次访问就是1
            $save_count = Redis::command('HINCRBY', [$cacheKey, $ip, 1]);
            //redis中这个存储浏览量的值达到30后,就去刷新一次数据库
            if($save_count == self::postViewLimit){
                $this->updateModelViewCount($id, $save_count);
                //本篇post,redis中浏览量刷进MySQL后,把该篇post的浏览量键抹掉,等着下一次请求重新
                Redis::command('HDEL', [$cacheKey, $ip]);
                //同时,抹掉post内容的缓存键,这样就不用等10分钟后再更新view_count了,
                //如该篇post在100秒内就达到了30访问量,就在3分钟时更新下MySQL,并把缓存抹掉,下一次请求就从MySQL中请求到最新的view_count,
                //当然,100秒内view_count还是缓存的旧数据,极端情况300秒内都是旧数据,而缓存里已经有了29个新增访问量
                //实际上也可以这样做:在缓存post的时候,可以把view_count单独拿出来存入键值里如single_view_count,每一次都是给这个值加1,然后把这个值传入视图里
                //或者平衡设置下postViewLimit和ipExpireSec这两个参数,对于view_count这种实时性要求不高的可以这样做来着
                //加上laravel前缀,因为Cache::remember会自动在每一个key前加上laravel前缀,可以看cache.php中这个字段:'prefix' => 'laravel'
                Redis::command('DEL', ['laravel:post:cache:'.$id]);
            }
        }else{
            //哈希类型指令HSET,和数组类似,就像$cacheKey[$ip] = 1;
            Redis::command('HSET', [$cacheKey, $ip, '1']);
        }

    }
    
    
}
