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

//前台首页
Route::get('/','HomeController@index');
//发表帖子页面
Route::get('/post/add','PostController@add');
//帖子详情
Route::resource('post','PostController',['only' => [
    'show','store'
]]);
//获取版块
Route::get('/getCategory','CategoryController@category');
//贴子浏览次数+1
Route::get('/set_hits','CommonController@set_hits');

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
    //发出评论
    Route::post('/doComment','CommentController@doComment');
});



