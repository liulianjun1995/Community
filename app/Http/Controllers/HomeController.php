<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegRequest;
use App\Mail\AccountMail;
use App\Model\Category;
use App\Model\Post;
use App\Model\UserActivation;
use App\User;
use Auth;
use Illuminate\Support\Facades\Request;
use Socialite;
use Validator;
use Mail;



class HomeController extends Controller
{
    //首页
    public function index()
    {
        //置顶帖获取5个
        $tops = Post::where('is_top','1')->take(5)->get();
        session()->put('tops',$tops);
        //非置顶帖
        $posts = Post::where('is_top','0')->orderBy('created_at','desc')->paginate(10);
        //预加载
        $posts->load('user','category','comments','visitors');
        return view('home.index.index',compact('posts'));
    }
    //关于
    public function about()
    {
        return view('home.index.about');
    }
    //登录页面
    public function loginIndex()
    {
        return view('home.index.login');
    }
    //github登录页面
    public function github()
    {
        return Socialite::driver('github')->redirect();
    }
    //github登录处理
    public function githubLogin()
    {
        $user = Socialite::driver('github')->user();
        if(!User::where('github_id',$user->id)->first()){
            $userModel = new User;
            $userModel->github_id = $user->id;
            $userModel->email = $user->email;
            $userModel->name = $user->nickname;
            $userModel->avatar = $user->avatar;
            $userModel->password = bcrypt(str_random(16));
            $userModel->save();
        }
        $userInstance = User::where('github_id',$user->id)->first();
        Auth::login($userInstance);
        return redirect()->action('HomeController@index');
    }
    //登录验证
    public function login(LoginRequest $request)
    {
        //验证邮箱还是手机号
        $field = filter_var($request->get('login'),FILTER_VALIDATE_EMAIL) ? 'email': 'phone';
        //登录匹配
        if (Auth::attempt(["$field"=> $request->get('login'),'password'=>request('password')])){
            $user = Auth::user();
            $user->last_login_time = date("Y-m-d H:i:s");
            $user->save();
            return [
              'error' => '1',
              'msg' => '登陆成功'
            ];
        }else{
            return [
                'error' => '0',
                'msg' => '用户名或密码有误'
            ];
        }
    }
    //注册页面
    public function regIndex()
    {
        return view('home.index.reg');
    }
    //注册逻辑
    public function reg(RegRequest $request)
    {
        $data = $request->except('_token');
        $data['password'] = bcrypt($data['password']);
        $res = User::create($data);
        if ($res){
            $token = bcrypt($res->email.time());
            UserActivation::create(['token'=> $token,'user_id'=>$res->id]);
            Mail::to($res->email)->send(new AccountMail($res,$token));
            return 1;
        }else{
            return 0;
        }
    }
    //退出登录
    public function logout()
    {
        Auth::logout();
        return redirect()->action('HomeController@index');
    }

    public function accountActivation()
    {
        if (UserActivation::where('user_id',\request('uid'))->where('token',\request('token'))->exists()){
            UserActivation::where('user_id',\request('uid'))->where('token',\request('token'))->update(['active'=>true]);
            return view('home.index.login')->with(['account'=>'激活成功']);
        }
    }
}

















