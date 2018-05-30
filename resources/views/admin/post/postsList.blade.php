@extends('admin.layouts.main')
@section('content')
    <style>
        /* 分页的样式 */
        .pagination {
            padding-left: 0;
            border-radius: 4px;
            display: inline-block;
        }
        .pagination>li>a:hover {
            z-index: 2;
            color: #216a94;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
            color: #777;
            background-color: #fff;
            border-color: #ddd;
            cursor: not-allowed;
        }
        .pagination>.disabled>span{
            color: #777;
            background-color: #fff;
            border-color: #ddd;
            cursor: not-allowed;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            line-height: 1.6;
            text-decoration: none;
            color: #3097D1;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-left: -1px;
        }
        .pagination>li {
            display: inline;
        }
        .pagination>.active>span,.pagination>.active>span:hover{
            z-index: 3;
            color: #fff;
            background-color: #3097D1;
            border-color: #3097D1;
            cursor: default;
        }
    </style>
    <!-- layui.css -->
    <link href="/assets/layui/css/layui.css" rel="stylesheet" />
    <script src="/assets/layui/layui.js"></script>
    <fieldset id="articleConsole" class="layui-elem-field layui-field-title" style="display:block;text-align: center">
        <legend>控制台</legend>
        <div class="layui-field-box">
            <div id="articleIndexTop">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item" style="margin:0;margin-top:15px;">
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input type="text" name="keywords" placeholder="请输入用户名或邮箱" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-input-inline" style="width:auto">
                                <button class="layui-btn" lay-submit="" lay-filter="formSearch">搜索</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;text-align: center">
        <legend id="articleBoxTitle">帖子列表</legend>
        <div class="layui-field-box">
            <div id="articleContent" class="">
                <table style="width: auto;margin: 0 auto" class="layui-table" lay-even="">
                    <colgroup>
                        <col width="80">
                        <col width="100">
                        <col width="80">
                        <col width="200">
                        <col width="80">
                        <col width="180">
                        <col width="80">
                        <col width="80">
                        <col width="80">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>发帖人</th>
                        <th>版块</th>
                        <th>标题</th>
                        <th>链接</th>
                        <th>发布时间</th>
                        <th colspan="2">选项</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>{{$post->title}}</td>
                            <td><a class="layui-btn layui-btn-small layui-btn-normal" href="/post/{{ $post->id }}" target="_blank">
                                    查看
                                </a></td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                @if($post->is_top ==1)
                                <button class="layui-btn layui-btn-small layui-btn-normal layui-btn-danger" onclick="cancelTop(this,{{ $post->id }})">
                                    取消置顶
                                </button>
                                @else
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="setTop(this,{{ $post->id }})">
                                    置顶
                                </button>
                                @endif
                            </td>
                            <td>
                                @if($post->is_sticky == 1)
                                <button class="layui-btn layui-btn-small layui-btn-normal layui-btn-danger" onclick="cancelSticky(this,{{ $post->id }})">
                                    取消加精
                                </button>
                                @else
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="setSticky(this,{{ $post->id }})">
                                    加精
                                </button>
                                @endif
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="delPost(this,{{ $post->id }})">
                                    删除
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $posts->render() }}
            </div>
        </div>
    </fieldset>
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        layui.use(['layer'],function () {
            var layer = layui.layer;
        });
        function delPost(obj,id) {
            layer.confirm('是否删除？', {
                btn: ['是','否'] //按钮
            }, function(){
                //删除
                $.ajax({
                    url:'/admin/post/'+id+'/delPost',
                    type:'post',
                    dataType:'json',
                    success:function (res) {
                        if(res.error == 0){
                            $(obj).parent().parent().remove();
                            layer.msg('删除成功');
                        }else{
                            layer.msg('删除失败，请重试');
                        }
                    },
                    error:function () {
                        layer.msg('请求失败，请稍后再试');
                    }
                });

            }, function(){

            });
        }
        function setTop(obj,id) {
            $.ajax({
                url:"/admin/post/"+id+'/setTop',
                type:"post",
                dataType:'json',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.text('取消置顶');
                        target.addClass('layui-btn-danger');
                        target.attr('onclick',"cancelTop(this,"+id+")");
                    }else{
                        layer.msg('请求失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        function cancelTop(obj,id) {
            $.ajax({
                url:"/admin/post/"+id+'/cancelTop',
                type:"post",
                dataType:'json',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.text('置顶');
                        target.removeClass('layui-btn-danger');
                        target.attr('onclick',"setTop(this,"+id+")");
                    }else{
                        layer.msg('请求失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        //加精
        function setSticky(obj,post_id) {
            $.ajax({
                url:"/admin/post/"+post_id+'/setSticky',
                type:"post",
                dataType:'json',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.text('取消加精');
                        target.addClass('layui-btn-danger');
                        target.attr('onclick',"cancelSticky(this,"+post_id+")");
                    }else{
                        layer.msg('请求失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        //取消加精
        function cancelSticky(obj,post_id) {
            $.ajax({
                url:"/admin/post/"+post_id+'/cancelSticky',
                type:"post",
                dataType:'json',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.text('加精');
                        target.removeClass('layui-btn-danger');
                        target.attr('onclick',"setSticky(this,"+post_id+")");
                    }else{
                        layer.msg('请求失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
    </script>
@endsection