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
        return $this->hasMany('App\Model\Comment','user_id','id');
    }

    /**
     * 我的帖子
     */
    public function posts()
    {
        return $this->hasMany('App\Model\Post','post_id','id');
    }

}


