@extends('layouts.main')

@section('container')
    <style>
        .fly-shortcut li {
            text-align: center;
        }
        .fly-shortcut li .layui-icon {
            background-color: #2F9688;
        }
        .fly-shortcut li .layui-icon {
            display: inline-block;
            width: 100%;
            height: 60px;
            line-height: 60px;
            text-align: center;
            color: #fff;
            border-radius: 2px;
            font-size: 30px;
            transition: all .3s;
            -webkit-transition: all .3s;
        }
        .layui-icon {
            font-family: layui-icon!important;
            font-size: 16px;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .fly-shortcut li cite {
            position: relative;
            top: 2px;
            display: block;
            color: #666;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            font-size: 14px;
        }
        a cite {
            font-style: normal;
        }
        .fly-panel-border {
            border: 1px solid #e6e6e6;
            box-shadow: none;
        }
        .fly-panel {
            margin-bottom: 15px;
            border-radius: 2px;
            background-color: #fff;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,.05);
        }
    </style>
  <div class="layui-container fly-marginTop fly-user-main">
    @include('home.user.main')

    <div class="fly-panel fly-panel-user" pad20 style="padding-top: 20px;">
        <div class="fly-msg" style="margin-bottom: 20px;"> Hi，{{ Auth::user()->name}}，你已是我们的正式社员。 
        </div>
        <div class="layui-col-md12">
            <div class="fly-panel fly-panel-border">
                <div class="fly-panel-title"> 快捷方式 </div>
                <div class="fly-panel-main">
                    <ul class="layui-row layui-col-space10 fly-shortcut">
                        <li class="layui-col-sm3 layui-col-xs4">
                            <a href="{{ url('/user/set/info') }}">
                                <i class="layui-icon"></i>
                                <cite>修改信息</cite>
                            </a>
                        </li>
                        <li class="layui-col-sm3 layui-col-xs4">
                            <a href="{{ url('/user/set/avatar') }}">
                                <i class="layui-icon"></i>
                                <cite>修改头像</cite>
                            </a>
                        </li>
                        <li class="layui-col-sm3 layui-col-xs4">
                            <a href="{{ url('/user/set/pass') }}">
                                <i class="layui-icon"></i>
                                <cite>修改密码</cite>
                            </a>
                        </li>
                        <li class="layui-col-sm3 layui-col-xs4">
                            <a href="{{ url('/user/set/bind') }}">
                                <i class="layui-icon"></i>
                                <cite>账号绑定</cite>
                            </a>
                        </li>
                        <li class="layui-col-sm3 layui-col-xs4">
                            <a href="{{ url('/user/post/add') }}">
                                <i class="layui-icon"></i>
                                <cite>发布新帖</cite>
                            </a>
                        </li>
                        <li class="layui-col-sm3 layui-col-xs4">
                            <a href="/">
                                <i class="layui-icon"></i>
                                <cite>查看分享</cite>
                            </a>
                        </li>
                        <li class="layui-col-sm3 layui-col-xs4">
                            <a href="{{ url('/user/posts/collection') }}">
                                <i class="layui-icon"></i>
                                <cite>我的收藏</cite>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>  
  </div>

@endsection