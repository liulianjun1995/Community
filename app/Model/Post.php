<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

    protected $fillable = [
        'category_id','title','content','reward','user_id'
    ];

    /**
     * 获取模型的索引名称
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'posts_index';
    }

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
        return $this->hasMany('App\Model\Comment')->orderBy('is_accept','desc')->orderBy('created_at','desc');
    }
    //文章浏览次数
    public function visitors()
    {
        return $this->hasMany('App\VisitorRegistry','post_id','id');
    }
    
    //判断一个用户是否收藏了这篇文章
    public function savePost($user_id)
    {
        return $this->hasOne(\App\Model\SavePost::class)->where('user_id',$user_id);
    }

}
