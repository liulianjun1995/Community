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



}
