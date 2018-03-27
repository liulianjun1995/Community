<?php

namespace App\Http\Controllers;

use App\Events\PostViewEvent;
use App\Http\Requests\Request;
use App\Listeners\PostEventListener;
use App\Model\Zan;
use Validator;
use App\Model\Category;
use App\Model\Post;
use Auth;
use Illuminate\Support\Facades\Cache;
use Visitor;

class PostController extends Controller
{

    //发表帖子页面
    public function create(){
        $categorys = Category::all();
        return view('home.post.create',compact('categorys'));
    }

    //const modelCacheExpires = 1;
    //帖子详情
    public function show($id)
    {
        // //Redis缓存中没有该post,则从数据库中取值,并存入Redis中,该键值key='post:cache'.$id生命时间1分钟
        // $post = Cache::remember('post:cache:'.$id,self::modelCacheExpires,function () use ($id){
        //     return Post::whereId($id)->first();
        // });

        // //获取客户端请求的ip
        // $ip = request()->ip();

        // //触发浏览次数统计时间
        // event(new PostViewEvent($post,$ip));
        $post = Post::whereId($id)->first();
        Visitor::log($id);
        return view('home.post.detail',compact('post'));
    }

    //发布新帖逻辑
    public function store()
    {
        $validator  = Validator::make(request()->all(),[
            'category' => 'required',
            'title' => 'required|min:5|max:50',
            'content' => 'required',
            'reward' => 'required|integer',
        ]);
        if ($validator->fails()){
            //有错误
            return $validator->errors();
        }else{
            $user_id = Auth::id();
            $category_id = request('category');
            $title = request('title');
            $content = request('content');
            $reward = request('reward');
            if (Post::create(compact('category_id','title','content','reward','user_id'))){
                return 1 ;
            }else{
                return 0 ;
            }
        }
    }
    
    //修改新帖页面
    public function edit($id)
    {
        $post = Post::find($id);
        return view('home.post.edit',compact('post'));
    }
    //修改帖子
    public function update($id)
    {
        if (Post::findOrFail($id)->user->id != Auth::id()){
            return [
                'auth' => '您没有操作权限'
            ];
        }

        $validator  = Validator::make(request()->all(),[
            'title' => 'required|min:5|max:50',
            'content' => 'required',
        ]);

        if ($validator->fails()){
            //有错误
            return $validator->errors();
        }else{
            $status = Post::where('id',$id)->update(['title'=>\request('title'),'content'=>\request('content')]);
            if ($status){
                return 1;
            }else{
                return 0;
            }
        }
    }

    //热门帖子
    public function hotPosts()
    {
        $hotPosts = Post::has('comments', '>=', 3)->withCount('comments')->orderBy('comments_count','desc')->get();
        return $hotPosts;
    }

    //获取公告
    public function getGonggao(){
        $post = Post::where('category_id',4)->take(4)->get();
        return $post;
    }
    
    //搜索
    public function search()
    {
        $posts = Post::search(\request('content'))->paginate(10);
        $msg = "以下是和<a style='color: red'>【".\request('content')."】</a>有关的内容";
        return view('home.index.index',compact('posts','msg'));
    }

}
