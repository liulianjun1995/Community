<?php

namespace App\Http\Controllers;

use App\Model\Zan;
use Validator;
use App\Model\Category;
use App\Model\Post;
use Auth;

class PostController extends Controller
{

    //发表帖子页面
    public function add(){
        $categorys = Category::all();
        return view('home.post.add',compact('categorys'));
    }

    //帖子详情
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $renqi = $post->renqi;
        $post->renqi = $renqi + 1;
        $post->save();

        $post = Post::where('id',$id)->first();
        return view('home.post.detail',compact('post'));
    }

    //发布新帖逻辑
    public function store()
    {
        $validator  = Validator::make(request()->all(),[
            'category' => 'required',
            'title' => 'required|min:5|max:50',
            'my-editormd-html-code' => 'required',
            'reward' => 'required|integer',
        ]);
        if ($validator->fails()){
            //有错误
            return $validator->errors();
        }else{
            $user_id = Auth::id();
            $category_id = request('category');
            $title = request('title');
            $content = request('my-editormd-html-code');
            $reward = request('reward');
            if (Post::create(compact('category_id','title','content','reward','user_id'))){
                return 1 ;
            }else{
                return 0 ;
            }
        }
    }



}
