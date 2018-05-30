<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test','CommonController@test');
//前台首页
Route::get('/','HomeController@index');
//积分商城
Route::get('/shop','GoodsController@index');
//关于
Route::get('/about','HomeController@about')->name('about');
//热门帖子
Route::get('hotPosts','PostController@hotPosts');
//获取推荐帖
Route::get('recommendations','PostController@recommendations');
//获取活跃榜
Route::get('getActiveRank','UserController@getActiveRank');
//获取公告
Route::get('getGonggao','PostController@getGonggao');
//帖子详情
Route::resource('post','PostController',['only' => [
    'show'
]]);
//搜索
Route::get('search','PostController@search');
//某个版块下的帖子
Route::get('/category/{id}/all','CategoryController@posts');
//根据板块获得帖子
Route::get('/category/{category_id}/{status}','CategoryController@post_status')->where('status','1|2|3');
//获取版块
Route::get('/getCategory','CategoryController@category');
//GitHub登录页面
Route::get('/github','HomeController@github');
//登录操作
Route::get('/github/login','HomeController@githubLogin');
//刷新验证码
Route::get('/refereshcapcha','CommonController@refereshcapcha');
//帖子状态tap
Route::get('/posts/{status}','PostController@post_status')->where('status','1|2|3');
//获取用户的评论
Route::get('/user/{user_id}/getComments','UserController@getComments');
//获取用户的帖子
Route::get('/user/{user_id}/getPosts','UserController@getPosts');

//用户相关操作
Route::group(['prefix'=>'user'],function (){
    //登录页面
    Route::get('/login','HomeController@loginIndex');
    //登录验证
    Route::post('/login','HomeController@login');
    //注册页面
    Route::get('/reg','HomeController@regIndex');
    //注册逻辑
    Route::post('/reg','HomeController@reg');
    Route::get('/accountActivation','HomeController@accountActivation');
    //其他用户主页
    Route::get('/{id}/home','UserController@userHome');

    //需要用户登录验证
    Route::group(['middleware'=> ['checkLogin']],function (){
        //退出登录
        Route::get('/logout','HomeController@logout');
        //个人资料页面
        Route::get('/set/info','UserController@set');
        //修改个人资料
        Route::post('/info','UserController@info');
        //头像
        Route::get('/set/avatar','UserController@set');
        //修改头像
        Route::post('/upload','UserController@upload');
        //上传图片
        Route::post('/uploadImg','CommonController@file_up');
        //修改密码
        Route::get('/set/pass','UserController@set');
        //账号绑定
        Route::get('/set/bind','UserController@set');
        //用户中心
        Route::get('/index','UserController@index');
        //帖子路由
        Route::resource('post','PostController',['only' => [
            'create','store','edit','update','destroy'
        ]]);
        //收藏帖子
        Route::post('/savePost','UserController@savePost');
        //取消收藏帖子
        Route::post('/unsavePost','UserController@unsavePost');
        //我发表的帖子
        Route::get('/posts/index','UserController@posts');
        //我收藏的帖子
        Route::get('/posts/collection','UserController@posts');
        //发出评论
        Route::post('/doComment','CommentController@doComment');
        //删除评论
        Route::post('/delComment','CommentController@delComment');
        //采纳评论
        Route::post('/acceptComment','CommentController@acceptComment');
        //赞评论
        Route::get('/{id}/zan','CommentController@zan');
        //取消赞
        Route::get('/{id}/unzan','CommentController@unzan');
        //我的消息
        Route::get('/message','UserController@message');
        //消息标记已读
        Route::post('/readMessage','UserController@readMessage');
        //签到
        Route::post('/{id}/signin','UserController@signin');
        //绑定手机号页面
        Route::get('/bindPhone',function (){
            return view('home.user.bindPhone');
        });
        //绑定手机号
        Route::post('/bindPhone','UserController@bindPhone');
        //兑换商品
        Route::post('/changeGoods','UserController@changeGoods');
        //我的物品
        Route::get('/goods','UserController@goods');
        //用户使用物品
        Route::post('/goods/{goods}/useGoods','UserController@useGoods');
    });

});

//管理员权限操作
Route::group(['middleware' => 'can:post'],function (){
    //帖子置顶
    Route::post('/post/{post}/setTop','PostController@setTop');
    //帖子取消置顶
    Route::post('/post/{post}/cancelTop','PostController@cancelTop');
    //帖子加精
    Route::post('/post/{post}/setSticky','PostController@setSticky');
    //帖子取消加精
    Route::post('/post/{post}/cancelSticky','PostController@cancelSticky');
    //帖子删除
    Route::post('/post/{post_id}/del','PostController@delPostByAdmin');
});


include_once 'admin.php';



