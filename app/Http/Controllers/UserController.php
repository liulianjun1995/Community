<?php

namespace App\Http\Controllers;


use App\Model\Comment;
use App\Model\Goods;
use App\Model\GoodsType;
use App\Model\Post;
use App\Model\SavePost;
use App\Model\UserUseGoods;
use App\User;
use Auth;
use App\Model\Message;
use Validator;
use Request;
use Toplan\Sms\Facades\SmsManager;

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
        $validator  = Validator::make(request()->all(),[
            'sex' => 'required',
            'city' => 'required',
        ]);
        if ($validator->fails()){
            //有错误
            return $validator->errors();
        }

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
        //文件名
        $file_tmp = $_FILES["file"]["tmp_name"];
        //错误代码
        $file_error = $_FILES["file"]["error"];
        //文件大小
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
                //判断当前的目录是否存在，若不存在就新建一个!
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
    //用户主页
    public function userHome($id)
    {
        $user = User::find($id);
        return view('home.user.home',compact('user'));
    }
    //我的帖子
    public function posts()
    {
        //我的帖子
        $posts = Post::where('user_id',\Auth::id())->paginate(10);
        //收藏的帖子
        $savePosts = SavePost::where('user_id',Auth::id())->paginate(10);
        return view('home.user.post',compact('posts','savePosts'));
    }
    //我的物品
    public function goods()
    {
        //商品类别
        $types = GoodsType::all();
        //我的物品
        $goods = Auth::user()->goods;
        return view('home.user.goods',compact('types','goods'));
    }
    //我的消息
    public function message()
    {
        $messages = Message::where('to_user_id',Auth::id())
            ->orderBy('created_at','desc')
            ->paginate(10);
        return view('home.user.message',compact('messages'));
    }
    //标记消息已读
    public function readMessage()
    {
        Message::where('to_user_id',Auth::id())->update(['is_read'=>true]);
        return [
          'msg' => ''
        ];
    }
    //活跃用户
    public function getActiveRank()
    {
        $users = User::has('comments', '>=', 1)->withCount('comments')->orderBy('comments_count','desc')->get();
        return $users;
    }
    //用户签到
    public function signin($id)
    {
        if (Auth::id()==$id){
            $user = Auth::user();
            $last_sign_time = strtotime($user->last_sign_time);
            //是否有过签到记录
            if ($last_sign_time){
                //有签到记录,先判断用户今天是否签到
                if ($user->is_sign()){
                    //今天签到了
                    return [
                      'error' => '0',
                      'msg' => '今天已经签到过了'
                    ];
                }else{
                    //今天没签到，判断是否中间某天是否有漏签
                    $begin_time = time();
                    $end_time = $last_sign_time;
                    $result = $this->timediff($begin_time,$end_time);
                    if ($result['day']>1){
                        //漏签了，累计天数变为1
                        $total_sign_day = 1;
                    }else{
                        //没漏签,累计
                        $total_sign_day = $user->total_sign_day + 1;
                    }
                    $result = $this->updateSign($total_sign_day,$id);
                    if ($result['status']){
                        return [
                            'error' => '1',
                            'msg' => '签到成功',
                            'addReward' => $result['addReward'],
                            'total_sign_day'=>$result['total_sign_day']
                        ];
                    }else{
                        return [
                            'error' => '0',
                            'msg' => '签到失败'
                        ];
                    }
                }

            }else{
                //没有签到记录
                $result = $this->updateSign(1,$id);
                if ($result['status']){
                    return [
                        'error' => '1',
                        'msg' => '签到成功',
                        'addReward' => $result['addReward'],
                        'total_sign_day'=>$result['total_sign_day']
                    ];
                }else{
                    return [
                        'error' => '0',
                        'msg' => '签到失败'
                    ];
                }
            }

        }else{
            return [
              'error' => '0',
              'msg' => '请登录'
            ];
        }
    }
    //用户绑定手机号
    public function bindPhone()
    {
        //验证数据
        $validator = \Validator::make(request()->all(), [
            'phone'     => 'required|confirm_mobile_not_change|unique:users',
            'verifyCode' => 'required|verify_code',
        ]);
        if ($validator->fails()) {
            //验证失败后建议清空存储的发送状态，防止用户重复试错
            SmsManager::forgetState();
            return redirect()->back()->withErrors($validator);
        }
        $user = Auth::user();
        if (!$user->phone){
            $user->phone = request('phone');
            $user->save();
            return redirect()->action('UserController@set');
        }else{
            return redirect()->back()->withErrors('您已绑定手机号');
        }

    }
    //收藏帖子
    public function savePost()
    {
        $post_id = request('post_id');
        $user_id = Auth::id();
        if (SavePost::create(compact('post_id','user_id'))){
            return [
                'error' => '0',
                'msg' => '收藏成功'
            ];
        }else{
            return [
                'error' => '1',
                'msg' => '收藏失败'
            ];
        }
    }
    //取消收藏帖子
    public function unsavePost()
    {
        $post_id = request('post_id');
        $user_id = Auth::id();
        if (SavePost::where('user_id',$user_id)->where('post_id',$post_id)->delete()){
            return [
                'error' => 0,
                'msg' => '取消收藏成功'
            ];
        }else{
            return [
                'error' => '1',
                'msg' => '取消收藏失败'
            ];
        }
    }
    //获取用户评论
    public function getComments($user_id)
    {
        $comments = Comment::where('user_id',$user_id)->with('post')->orderBy('created_at','desc')->paginate(4);
        return $comments;
    }
    //获取用户的帖子
    public function getPosts($user_id)
    {
        $posts = Post::where('user_id',$user_id)
            ->with(['category'])
            ->withCount(['comments'])
            ->orderBy('created_at','desc')
            ->paginate(10);
        return $posts;
    }
    //用户兑换商品
    public function changeGoods()
    {
        $goods = Goods::find(request('goods_id'));
        if ($goods->number == 0){
            return [
                'error' => '1',
                'msg' => '商品库存不足~~',
            ];
        }
        $number = $goods->number;
        $goods->number = ($number-1);

        $user = Auth::user();
        $reward = $user->reward;
        $user->reward = $reward-($goods->price);
        if ($user->assignGoods($goods) && $goods->save() && $user->save()){
            return [
                'error' => '0',
                'msg' => '兑换成功'
            ];
        }else{
            return [
                'error' => '1',
                'msg' => '兑换失败'
            ];
        }

    }
    //用户使用物品
    public function useGoods(Goods $goods)
    {
        $goods_id = $goods->id;
        $type_id = $goods->type_id;
        $user_id = Auth::id();
        if (UserUseGoods::updateOrCreate(compact('user_id','type_id'),compact('goods_id'))){
            return [
                'error' => '0',
                'msg' => '使用成功'
            ];
        }else{
            return [
                'error' => '1',
                'msg' => '使用失败'
            ];
        }
    }







    /**
     * 计算相差天数
     * @param $begin_time 开始时间戳
     * @param $end_time 结束时间戳
     */
    function timediff($begin_time,$end_time){
        if ($begin_time<$end_time){
            $startTime = $begin_time;
            $endTime =$end_time;
        }else{
            $startTime = $end_time;
            $endTime =$begin_time;
        }

        //去掉时分秒再计算时间戳
        $startTime = strtotime(date('Y-m-d',intval($startTime)));
        $endTime = strtotime(date('Y-m-d',intval($endTime)));

        //计算天数
        $timediff = $endTime-$startTime;
        $days = intval($timediff/86400);
        $res = array('day'=>$days);
        return $res;
    }

    /**
     * 更新用户本次签到后的积分、时间和累计签到天数
     * @param $sign_day 累计签到天数
     * @param $id 签到用户id
     */
    function updateSign($total_sign_day,$id){
        if ($total_sign_day<5){
            $addReward = 5;
        }else if($total_sign_day>=5){
            $addReward = 10 ;
        }else if ($total_sign_day>=15){
            $addReward = 15;
        }else if ($total_sign_day>=30){
            $addReward = 30;
        }

        $user = User::find($id);
        //累计签到天数
        $user->total_sign_day = $total_sign_day ;
        //本次签到积分
        $reward = $user->reward;
        $user->todaySignReward = $addReward;
        //总积分
        $user->reward = $reward+$addReward;
        //签到时间
        $user->last_sign_time = date("Y-m-d H:i:s") ;
        $status = $user->save();
        return array('status'=>$status,'addReward'=>$addReward,'total_sign_day'=>$total_sign_day);
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
