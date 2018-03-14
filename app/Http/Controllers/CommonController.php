<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Post;
use Illuminate\Support\Facades\Redis;
use Mail;
use Toplan\PhpSms\Sms;
class CommonController extends Controller
{
    //文件上传
    public function file_up()
    {
        $file = Input::file('editormd-image-file');
        $result = array();
        if (empty($file) || $file == null){ //如果没有选择文件
            $result['success'] = 0;
            $result['message'] = '请选择图片';
            $result['url'] = '';
        }else{
            $extension = $file->getClientOriginalExtension(); //上传文件后缀
            $newName = date('YmdHis').mt_rand(100,999).'.'.$extension;  //设置新文件的名称
            $path = $file->move(base_path().'/public/upload/'.date('Ymd'),$newName);    //将文件移动到新地址
            $filepath = '/upload/'.date('Ymd').'/'.$newName; //上传的路径与新名字
            if ($path){
                //如果选择文件成功上传
                $result['success'] = 1;
                $result['message'] = '上传成功';
                $result['url'] = "$filepath";
            }else{
                //如果选择文件上传失败
                $result['success'] = 0;
                $result['message'] = '上传出错';
                $result['url'] = '';
            }

        }
        return json_encode($result); //返回必须为json格式
    }
    


    public function test()
    {
        /*
        Mail::raw('恭喜你注册成功！',function ($message){
            $message->subject('激活邮件');
            $message->to('903993979@qq.com');
        });
        */


    }

}
