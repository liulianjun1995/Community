<?php

namespace App\Http\Controllers;

use App\Events\PostViewEvent;
use App\Listeners\PostEventListener;
use App\Model\Comment;
use App\Model\SavePost;
use App\Model\Zan;
use App\User;
use Validator;
use App\Model\Category;
use App\Model\Post;
use Auth;
use Illuminate\Support\Facades\Cache;
use Visitor;
use DB;

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
        Visitor::log($id);
        $post = Post::find($id);
        
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

        if (Auth::user()->reward-request('reward')<0){
            return [
                'reward' => '您的飞吻不够，快去赚取飞吻吧'
            ];
        }

        if ($validator->fails()){
            //有错误
            return $validator->errors();
        }else{
            $user_id = Auth::id();
            $category_id = request('category');
            $title = request('title');
            $content = request('content');
            $reward = request('reward');
            $status = DB::table('users')->where('id',$user_id)->decrement('reward',$reward);
            if ($status && Post::create(compact('category_id','title','content','reward','user_id'))){
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
    //删除帖子
    public function destroy($id)
    {
        if (Auth::id() !== intval(request('user_id'))){
            return [
                'error' => '1',
                'msg' => '您没有权限操作'
            ];
        }
        if (Post::where('id',$id)->delete()){
            Comment::where('post_id',$id)->delete();
            SavePost::where('post_id',$id)->delete();
            return [
              'error' => '0',
              'msg' => '删除成功'
            ];
        }else{
            return [
                'error' => '1',
                'msg' => '删除失败'
            ];
        }
    }
    //热门帖子
    public function hotPosts()
    {
        $hotPosts = Post::has('comments', '>=', 3)->withCount('comments')->orderBy('comments_count', 'desc')->get();
        return $hotPosts;
    }
    //推荐帖子
    public function recommendations()
    {
        $recommendations = Post::where('is_sticky',true)->take(10)->get();
        return $recommendations;
    }
    //获取公告
    public function getGonggao(){
        $post = Post::where('category_id',4)->take(4)->get();
        return $post;
    }
    //搜索
    public function search()
    {
        $posts = Post::search(\request('query'))->paginate(10);
        $posts->load('user','category','comments','visitors');
        $msg = "以下是和【<a style='color: red'>".\request('query')."</a>】有关的内容";
        return view('home.index.index',compact('posts','msg'));
    }
    //根据帖子状态
    public function post_status($status)
    {
        if (in_array($status,['1','2','3'])){
            if ($status == '1'){
                $posts = Post::where('is_closed',false)->paginate(10);
            }else if ($status == '2'){
                $posts = Post::where('is_closed',true)->paginate(10);
            }else{
                $posts = Post::where('is_sticky',true)->paginate(10);
            }
        }else{
            return redirect()->action('HomeController@index');
        }
        return view('home.index.index',compact('posts'));
    }
    //帖子置顶
    public function setTop(Post $post)
    {
        $post->is_top=1;
        $post->save();
        return 1;
    }
    //帖子取消置顶
    public function cancelTop(Post $post)
    {
        $post->is_top=0;
        $post->save();
        return 1;
    }
    //帖子加精
    public function setSticky(Post $post)
    {
        $post->is_sticky=1;
        $post->save();
        return 1;
    }
    //帖子取消加精
    public function cancelSticky(Post $post)
    {
        $post->is_sticky=0;
        $post->save();
        return 1;
    }
    //管理员删除帖子
    public function delPostByAdmin($post_id)
    {
        if (Post::where('id',$post_id)->delete()){
            Comment::where('post_id',$post_id)->delete();
            SavePost::where('post_id',$post_id)->delete();
            return [
                'error' => '0',
                'msg' => '删除成功'
            ];
        }else{
            return [
                'error' => '1',
                'msg' => '删除失败'
            ];
        }
    }

}
