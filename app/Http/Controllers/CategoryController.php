<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Post;

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
        return view('home.index.index',compact('posts','category_id'));
    }

    public function post_status($category_id,$status)
    {
        if (in_array($status,['1','2','3'])){
            if ($status == '1'){
                $posts = Post::where('category_id',$category_id)->where('is_closed',false)->paginate(10);
            }else if ($status == '2'){
                $posts = Post::where('category_id',$category_id)->where('is_closed',true)->paginate(10);
            }else{
                $posts = Post::where('category_id',$category_id)->where('is_sticky',true)->paginate(10);
            }
        }else{
            return redirect()->action('HomeController@index');
        }
        return view('home.index.index',compact('posts','category_id'));
    }

}
