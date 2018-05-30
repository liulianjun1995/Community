<?php

namespace App;

use App\Model\AdminRole;
use App\Model\AdminUser;
use App\Model\DefriendUser;
use App\Model\GagUser;
use App\Model\Goods;
use App\Model\UserActivation;
use App\Model\UserGoods;
use App\Model\UserUseGoods;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email','name','password'
    ];

    //用户是否激活账户
    public function activations()
    {
        return $this->hasOne(UserActivation::class,'user_id','id');
    }
    
    /**
     * 我的评论
     */
    public function comments(){
        return $this->hasMany('App\Model\Comment','user_id','id')->orderBy('created_at','desc');
    }
    /**
     * 我的帖子
     */
    public function posts()
    {
        return $this->hasMany('App\Model\Post','user_id','id')->orderBy('created_at','desc');
    }
    /**
     * 收藏的帖子
     */
    public function save_posts()
    {
        return $this->hasMany('App\Model\savePost','user_id','id')->orderBy('created_at','desc');
    }
    /**
     * 我的未读评论
     */
    public function newMessages()
    {
        return $this->hasMany('App\Model\Message','to_user_id','id')->where('is_read','=',0)->orderBy('created_at','desc');
    }
    /**
     * 今天是否签到
     */
    public function is_sign()
    {
        $begin_time = time();
        $end_time = strtotime($this->last_sign_time);
        $result = $this->timediff($begin_time,$end_time);
        if ($result['day']==0) {
            //今天签到了
            return 1;
        }else{
            return 0;
        }
    }

    //用户是否为管理员
    public function isAdmin()
    {
        return $this->hasOne(AdminUser::class,'user_id','id');
    }
    //是否有权限
    public function hasPermission($permisson)
    {
        if ($this->isAdmin){
            $adminUser=$this->isAdmin;
            return $adminUser->hasPermission($permisson);
        }else{
            return false;
        }
    }
    //用户的所有兑换的商品
    public function goods()
    {
        return $this->belongsToMany(Goods::class,'user_goods','user_id','goods_id')->withPivot(['user_id','goods_id']);
    }
    //判断用户是否有某些商品
    public function isInGoods($goods){
        return !!$goods->intersect($this->goods)->count();
    }
    //给用户分配商品
    public function assignGoods($goods){
        return $this->goods()->save($goods);
    }
    //删除用户分配的商品
    public function deleteGoods($goods){
        return $this->goods()->detach($goods);
    }
    //用户是否有使用物品
    public function hasUseGoods()
    {
        return $this->hasMany(UserUseGoods::class,'user_id','id');
    }
    //用户使用的所有物品
    public function useGoods()
    {
        return $this->belongsToMany(Goods::class,'user_use_goods','user_id','goods_id');
    }
    //用户使用了头饰
    public function hat()
    {
        return $this->hasOne(UserUseGoods::class,'type_id','user_id');
    }
    //用户是否被禁言
    public function isGag()
    {
        return $this->hasOne(GagUser::class,'user_id','id');
    }
    //用户是否被拉黑
    public function isDefriend()
    {
        return $this->hasOne(DefriendUser::class,'user_id','id');
    }


    /**
     * 计算相差天数
     * @param $begin_time 开始时间戳
     * @param $end_time 结束时间戳
     */
    protected function timediff($begin_time,$end_time){
        if ($begin_time<$end_time){
            $startTime = $begin_time;
            $endTime =$end_time;
        }else{
            $startTime = $end_time;
            $endTime =$begin_time;
        }

        //去掉时分秒再计算时间戳
        $startTime = strtotime(date('Y-m-d',intval($startTime)));
        $endTime = strtotime(date('Y-m-d',intval($endTime)));

        //计算天数
        $timediff = $endTime-$startTime;
        $days = intval($timediff/86400);

        $res = array('day'=>$days);
        return $res;
    }


}


