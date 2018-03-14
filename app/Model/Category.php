<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * 版块下的所有帖子
     */
    public function posts(){
        return $this->hasMany('App\Model\Post','category_id','id');
    }
}
