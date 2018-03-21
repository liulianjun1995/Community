<?php

namespace App\Http\Controllers;
use App\Model\Category;
use App\Model\Post;
use App\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use Mail;


class HomeController extends Controller
{
    //首页
    public function index()
    {
        if (!session()->get('tops')){
            $tops = Post::where('is_top','1')->take(2)->get();
            session()->put('tops',$tops);
        }
        $posts = Post::where('is_top','0')->paginate(10);
        return view('home.index.index',compact('posts'));
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
        if (!User::where('github_id',$user->id)->first()){
            $userModel = new User;
            $userModel->github_id = $user->id;
            $userModel->email = $user->email;
            $userModel->name = $user->nickname;
            $userModel->avatar = $user->avatar;
            $userModel->password = bcrypt(str_random(16));
            $userModel->save();
        }
        $userInstance = User::where('github_id',$user->id)->firstOrFail();
        Auth::login($userInstance);
        return redirect()->action('HomeController@index');
    }
    //登录验证
    public function login()
    {
        //验证验证码
        $validator = Validator::make(request()->all(),[
            'captcha' => 'required|captcha',
        ]);
        if ($validator->fails()){
            //验证码错误
            return [
                'error' => '0',
                'msg' => '验证码错误'
            ];
        }
        //验证账号密码
        if (Auth::attempt(['email'=>request('email'),'password'=>request('password')])){
            return [
              'error' => '1',
              'msg' => '登陆成功'
            ];
        }else{
            return [
                'error' => '0',
                'msg' => '邮箱或密码有误'
            ];
        }
    }
    //注册页面
    public function regIndex()
    {
        return view('home.index.reg');
    }
    //注册逻辑
    public function reg()
    {
        $validator  = Validator::make(request()->all(),[
            'captcha' => 'required|captcha',
            'email' => 'required|email|unique:users',
            'name' => 'required|unique:users|min:2|max:10',
            'password' => 'required|min:4|max:20|confirmed',
            'password_confirmation' => 'required|min:4|max:20',
        ]);
        if ($validator->fails()){
            //有错误
            return $validator->errors();
        }
        //进行注册逻辑
        $email = request('email');
        $name = request('name');
        $password = bcrypt(request('password'));

        if(User::create(compact('email','name','password'))){

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
}

















