<?php
/**
 * Created by PhpStorm.
 * User: 75021
 * Date: 2018.5.16
 * Time: 16:52
 */
//用户
Route::get('/admin','Admin\HomeController@index');
Route::get('/admin/userList','Admin\UserController@userList');
Route::post('/admin/user/{user}/admin','Admin\UserController@admin');
Route::post('/admin/user/{user}/removeAdmin','Admin\UserController@removeAdmin');
Route::post('/admin/user/{user}/gag','Admin\UserController@gagUser');
Route::post('/admin/user/{user}/cancelGag','Admin\UserController@cancelGagUser');
Route::post('/admin/user/{user}/defriend','Admin\UserController@defriendUser');
Route::post('/admin/user/{user}/cancelDefriend','Admin\UserController@cancelDefriendUser');

//管理员
Route::get('/admin/adminList','Admin\AdminController@adminList');
Route::get('/admin/adminUser/{adminUser}/role','Admin\AdminController@role');
Route::post('/admin/adminUser/{adminUser}/assignRole','Admin\AdminController@assignRole');
//角色
Route::get('/admin/roleList','Admin\RoleController@roleList');
Route::get('/admin/role/create','Admin\RoleController@create');
Route::post('/admin/role/store','Admin\RoleController@store');
Route::get('/admin/role/{role}/edit','Admin\RoleController@edit');
Route::post('/admin/role/{role}/update','Admin\RoleController@update');
Route::post('/admin/role/{role}/delete','Admin\RoleController@delete');
//权限
Route::get('/admin/permissionList','Admin\PermissionController@permissionList');
Route::get('/admin/permission/create','Admin\PermissionController@create');
Route::post('/admin/permission/store','Admin\PermissionController@store');
Route::post('/admin/permission/{permission}/delete','Admin\PermissionController@delete');
//商品列表
Route::get('/admin/goodsList','Admin\GoodsController@goodsList');
Route::get('/admin/goods/create','Admin\GoodsController@create');
Route::post('/admin/goods/store','Admin\GoodsController@store');
Route::get('/admin/goods/{id}/editGoods','Admin\GoodsController@edit');
Route::post('/admin/goods/{id}/updateGoods','Admin\GoodsController@update');
Route::post('/admin/goods/{goods}/delete','Admin\GoodsController@delete');
Route::post('/admin/goods/{goods}/isUse','Admin\GoodsController@isUse');

//上传商品图片
Route::any('/admin/upload','Admin\GoodsController@upload');

//商品类别列表
Route::get('/admin/goodsTypeList','Admin\GoodsTypeController@typeList');
Route::get('/admin/goodsType/create','Admin\GoodsTypeController@create');
Route::post('/admin/goodsType/store','Admin\GoodsTypeController@store');
Route::get('/admin/goodsType/{id}/editType','Admin\GoodsTypeController@edit');
Route::post('/admin/goodsType/{id}/update','Admin\GoodsTypeController@update');
Route::post('/admin/goodsType/{id}/delete','Admin\GoodsTypeController@delete');