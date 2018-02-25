<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lxshequ - lxshequ.com</title>
    <link rel="stylesheet" href="{{ asset('/assets/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/layui/css/global.css') }}">
    <script src="{{ asset('/assets/js/jquery-2.1.4.js') }}"></script>
    <script src="{{ asset('/assets/js/layer.js') }}"></script>
    <script src="{{ asset('/assets/layui/layui.js') }}"></script>
</head>
<body>
<div class="fly-header layui-bg-cyan">
    <div class="layui-container">
        <a class="fly-logo" href="/">
            <img src="{{ asset('/assets/layui/images/1491.gif') }}" height="39px" width="100px">
        </a>
        <ul class="layui-nav fly-nav layui-hide-xs" style="margin-left: 120px">
            <li class="layui-nav-item layui-this">
                <a href="/"><i class="layui-icon"></i>首页</a>
            </li>
            <li class="layui-nav-item">
                <a href="case/case.html"><i class="iconfont icon-iconmingxinganli"></i>案例</a>
            </li>
            <li class="layui-nav-item">
                <a href="http://www.layui.com/" target="_blank"><i class="iconfont icon-ui"></i>框架</a>
            </li>
        </ul>

        <ul class="layui-nav fly-nav-user">

            <!-- 未登入的状态 -->
            <li class="layui-nav-item">
                <a class="iconfont icon-touxiang layui-hide-xs" href="user/login.html"></a>
            </li>
            <li class="layui-nav-item">
                <a href="user/login.html">登入</a>
            </li>
            <li class="layui-nav-item">
                <a href="user/reg.html">注册</a>
            </li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="javascript:void(0)" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" title="QQ登入" class="iconfont icon-qq"></a>
            </li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="/app/weibo/" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" title="微博登入" class="iconfont icon-weibo"></a>
            </li>

        </ul>
    </div>
</div>
</body>
</html>