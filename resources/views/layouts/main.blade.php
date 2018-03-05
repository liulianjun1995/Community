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
    <li class="layui-icon" lay-type="bar1"></li>
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
{{-- 创建一个富文本 --}}
<script type="text/javascript">
    $(function() {
        editormd("my-editormd", {//注意1：这里的就是上面的DIV的id属性值
            width   : "100%",
            height  : 640,
            emoji: true,
            syncScrolling : "single",
            tex: true,// 开启科学公式TeX语言支持，默认关闭
            path    : "{{ asset('/assets/editormd/lib') }}/",//注意2：你的路径
            saveHTMLToTextarea : true,//注意3：这个配置，方便post提交表单
            imageUpload : true,
            imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : "/user/uploadImg",//注意你后端的上传图片服务地址

        });
    });
</script>

<script src="{{ asset('/assets/js/home.js') }}"></script>
<script src="{{ asset('/assets/editormd/lib/marked.min.js') }}"></script>
<script src="{{ asset('/assets/editormd/lib/prettify.min.js') }}"></script>
<script src="{{ asset('/assets/editormd/lib/raphael.min.js') }}"></script>
<script src="{{ asset('/assets/editormd/lib/underscore.min.js') }}"></script>
<script src="{{ asset('/assets/editormd/lib/flowchart.min.js') }}"></script>
<script src="{{ asset('/assets/editormd/lib/sequence-diagram.min.js') }}"></script>
<script src="{{ asset('/assets/editormd/lib/jquery.flowchart.min.js') }}"></script>
<script src="{{ asset('/assets/editormd/editormd.js') }}"></script>

</body>
</html>