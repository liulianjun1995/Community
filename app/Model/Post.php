<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id','title','content','reward','user_id'
    ];
    /**
     * 文章所属用户
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    /**
     * 文章所属板块
     */
    public function category()
    {
        return $this->belongsTo('App\Model\Category','category_id','id');
    }

    /**
     * 文章的评论
     */
    public function comments()
    {
        return $this->hasMany('App\Model\Comment')->orderBy('created_at','desc');
    }



}
