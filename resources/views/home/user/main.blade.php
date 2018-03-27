<?php
$str = substr($_SERVER['REQUEST_URI'],6);
$uri = substr($str,0);
?>

<ul class="layui-nav layui-nav-tree layui-inline @if($uri=="home") layui-this @endif">
    <li class="layui-nav-item">
        <a href="/user/{{ Auth::id() }}/home">
            <i class="layui-icon">&#xe609;</i>
            我的主页
        </a>
    </li>
    <li class="layui-nav-item @if($uri=="index") layui-this @endif">
        <a href="{{ url('user/index') }}">
            <i class="layui-icon">&#xe612;</i>
            用户中心
        </a>
    </li>
    <li class="layui-nav-item @if(strpos($uri,'set')!==false) layui-this @endif">
        <a href="{{ url('/user/set/info') }}">
            <i class="layui-icon">&#xe620;</i>
            基本设置
        </a>
    </li>
    <li class="layui-nav-item @if(strpos($uri,'posts')!==false) layui-this @endif">
        <a href="{{ url('/user/posts/index') }}">
            <i class="layui-icon">&#xe60a;</i>
            我的帖子
        </a>
    </li>
    <li class="layui-nav-item @if($uri=="message") layui-this @endif">
        <a href="{{ url('/user/message') }}">
            <i class="layui-icon">&#xe611;</i>
            我的消息
        </a>
    </li>
</ul>


<div class="site-tree-mobile layui-hide">
    <i class="layui-icon">&#xe602;</i>
</div>
<div class="site-mobile-shade"></div>

<div class="site-tree-mobile layui-hide">
    <i class="layui-icon">&#xe602;</i>
</div>
<div class="site-mobile-shade"></div>