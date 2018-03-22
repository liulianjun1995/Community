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
//热门帖子
Route::get('hotPosts','PostController@hotPosts');
//获取活跃榜
Route::get('getActiveRank','UserController@getActiveRank');
//获取公告
Route::get('getGonggao','PostController@getGonggao');
//帖子详情
Route::resource('post','PostController',['only' => [
    'show','store'
]]);
//搜索
Route::get('search','PostController@search');
//某个版块下的帖子
Route::get('/category/{id}','CategoryController@posts');
//获取版块
Route::get('/getCategory','CategoryController@category');
//GitHub登录页面
Route::get('/github','HomeController@github');
//登录操作
Route::get('/github/login','HomeController@githubLogin');
//刷新验证码
Route::get('/refereshcapcha','CommonController@refereshcapcha');

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
    //其他用户主页
    Route::get('/{id}/home','UserController@userHome');

    //需要用户登录验证
    Route::group(['middleware'=>'checkLogin'],function (){
        //退出登录
        Route::get('/logout','HomeController@logout');
        //设置页面
        Route::get('/set','UserController@set');
        //修改个人资料
        Route::post('/info','UserController@info');
        //上传头像
        Route::post('/upload','UserController@upload');
        //上传图片
        Route::post('/uploadImg','CommonController@file_up');
        //用户中心
        Route::get('/index','UserController@index');
        //发表帖子页面
        Route::get('/post/add','PostController@add');
        //我发表的帖子
        Route::get('/index/post','UserController@index');
        //我收藏的帖子
        Route::get('/index/collection','UserController@index');
        //发出评论
        Route::post('/doComment','CommentController@doComment');
        //赞评论
        Route::get('/{id}/zan','CommentController@zan');
        //取消赞
        Route::get('/{id}/unzan','CommentController@unzan');
        //我的消息
        Route::get('/message',function (){
            return view('home.user.message');
        });
        //消息标记已读
        //签到
        Route::post('/{id}/signin','UserController@signin');
        //绑定手机号页面
        Route::get('/bindPhone',function (){
            return view('home.user.bindPhone');
        });
        Route::post('/bindPhone','UserController@bindPhone');
    });

});



