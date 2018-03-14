<?php

namespace App\Http\Controllers;


use App\Model\Post;
use App\User;
use function React\Promise\all;

class UserController extends Controller
{
    //个人设置页面
    public function set()
    {
        return view('home.user.set');
    }
    //修改个人资料
    public function info()
    {

        if (User::where('id',\Auth::id())->update(request()->all())){
            return 1;
        }else{
            return 0;
        }

    }
    //上传头像
    public function upload()
    {
        //上传图片具体操作
        $file_name = $_FILES['file']['name'];
        //$file_type = $_FILES["file"]["type"];
        $file_tmp = $_FILES["file"]["tmp_name"];
        $file_error = $_FILES["file"]["error"];
        $file_size = $_FILES["file"]["size"];
        if ($file_error > 0) { // 出错
            $message = $file_error;
        } elseif($file_size > 1048576) { // 文件太大了
            $message = "上传文件不能大于1MB";
        }else{
            $date = date('Ymd');
            $file_name_arr = explode('.', $file_name);
            $new_file_name = date('YmdHis') . '.' . $file_name_arr[1];
            $path = "upload/".$date."/";
            $file_path = $path . $new_file_name;
            if (file_exists($file_path)) {
                $message = "此文件已经存在啦";
            } else {
                //TODO 判断当前的目录是否存在，若不存在就新建一个!
                if (!is_dir($path)){mkdir($path,0777);}
                $upload_result = move_uploaded_file($file_tmp, $file_path);
                $avatar = "/".$file_path;
                //此函数只支持 HTTP POST 上传的文件
                $status = User::where('id',\Auth::id())->update(compact('avatar'));
                if ($upload_result && $status) {
                    $status = 1;
                    $message = $file_path;
                } else {
                    $message = "文件上传失败，请稍后再尝试";
                }
            }
        }
        return $this->showMsg($status, $message);
    }
    //用户中心
    public function index()
    {
        $posts = Post::where('user_id',\Auth::id())->paginate(10);
        return view('home.user.index',compact('posts'));
    }
    //我的主页
    public function home()
    {
        return view('home.user.home');
    }
    //其他用户主页
    public function userHome($id)
    {
        return view('home.user.home');
    }
    //活跃榜
    public function getActiveRank()
    {
        $users = User::has('comments', '>=', 1)->withCount('comments')->orderBy('comments_count','desc')->get();
        return $users;
    }

    function showMsg($status,$message = '',$data = array()){
        $result = array(
            'status' => $status,
            'message' =>$message,
            'data' =>$data
        );
        exit(json_encode($result));
    }

}
