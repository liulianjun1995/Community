<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>lxshequ - lxshequ.com</title>
    <link rel="shortcut icon" href="{{ asset('/assets/images/1491.gif') }}">
    <link rel="stylesheet" href="{{ asset('/assets/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/layui/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/my.css') }}">
    <link rel="stylesheet"href="{{ asset('/assets/editormd/css/editormd.css') }}" />
    <script src="{{ asset('/assets/js/jquery-2.1.4.js') }}"></script>
    <script src="{{ asset('/assets/js/layer.js') }}"></script>
    <script src="{{ asset('/assets/layui/layui.js') }}"></script>

</head>
<body onscroll="scroll()">
{{-- 导航栏 --}}
@include('layouts.header')
{{-- canvas图画 --}}
@include('layouts.canvas')
{{-- 板块 --}}
@include('layouts.category')
@yield('container')

@include('layouts.footer')

{{-- top锚点 --}}
<ul class="layui-fixbar">
    @login
    <li class="layui-icon" lay-type="bar1" onclick="window.location.href='{{ url('/user/post/create') }}'"></li>
    @else
    <li class="layui-icon" lay-type="bar1" onclick="layer.msg('请先登录')"></li>
    @endlogin
    <li class="layui-icon layui-fixbar-top" style="display: none;" onclick="$(document).scrollTop(0)"></li>
</ul>

<script>
    function scroll() {
        //变量t是滚动条滚动时，距离顶部的距离
        var t = document.documentElement.scrollTop||document.body.scrollTop;
        //当滚动到距离顶部200px时，返回顶部的锚点显示
        if(t>=200){
            $('.layui-fixbar-top').css('display', 'list-item');
        }else{
            //恢复正常
            $('.layui-fixbar-top').css('display', 'none');
        }
    }
</script>
<script src="{{ asset('/assets/js/canvas.js') }}"></script>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('js')

</body>
</html>