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
     * 获取模型的索引数据数组
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // 自定义数组...

        return $array;
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
        return $this->hasMany('App\Model\Comment')->orderBy('created_at','desc');
    }

}
