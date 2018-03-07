<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'user_id','post_id','content'
    ];

    /**
     * 评论所属用户
     */
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    /*
     * 评论所属帖子
     */
    public function post(){
        return $this->belongsTo('App\Model\Post','post_id','id');
    }

    /**
     * 判断用户是否赞了这条评论
     */
    public function zan($user_id){
        return $this->hasOne(\App\Model\Zan::class)->where('user_id',$user_id);
    }

    /**
     * 评论所有的赞
     */

    public function zans(){
        return $this->hasMany('App\Model\Zan','comment_id','id');
    }


}
