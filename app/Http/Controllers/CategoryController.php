<?php

namespace App\Http\Controllers;

use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * 获取所有的版块
     */
    public function category(){
        return Category::all();
    }

    /**
     * 版块下的帖子
     */
    public function posts($category_id){
        $posts =  Category::find($category_id)->posts()->paginate(10);
        return view('home.index.index',compact('posts'));
    }

}
