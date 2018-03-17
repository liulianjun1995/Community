<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email','name','password'
    ];

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


