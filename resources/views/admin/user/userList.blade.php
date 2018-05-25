@extends('admin.layouts.main')
@section('content')
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
        <legend id="articleBoxTitle">用户列表</legend>
        <div class="layui-field-box">
            <div id="articleContent" class="">
                <table style="" class="layui-table" lay-even="">
                    <colgroup>
                        <col width="50">
                        <col>
                        <col width="50">
                        <col width="50">
                        <col width="180">
                        <col width="80">
                        <col width="80">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>用户名</th>
                        <th>性别</th>
                        <th>邮箱</th>
                        <th>注册时间</th>
                        <th colspan="2">选项</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->sex}}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <form class="layui-form" action="">
                                    <div class="layui-form-item" style="margin:0;"  onclick="">
                                        <input type="checkbox" name="gag" title="禁言" value="" lay-filter="gag" >
                                        @if($user->isGag)
                                        <div class="layui-unselect layui-form-checkbox layui-form-checked" onclick="cancelGagUser(this,{{ $user->id }})">
                                        @else
                                        <div class="layui-unselect layui-form-checkbox" onclick="gagUser(this,{{ $user->id }})">
                                        @endif
                                            <span>禁言</span><i class="layui-icon"></i>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form class="layui-form" action="">
                                    <div class="layui-form-item" style="margin:0;" onclick="">
                                        <input type="checkbox" name="defriend" title="拉黑" value="" lay-filter="defriend">
                                        @if($user->isDefriend)
                                        <div class="layui-unselect layui-form-checkbox layui-form-checked" onclick="cancelDefriendUser(this,{{ $user->id }})">
                                        @else
                                        <div class="layui-unselect layui-form-checkbox" onclick="defriendUser(this,{{ $user->id }})">
                                        @endif
                                            <span>拉黑</span><i class="layui-icon"></i>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                @if($user->isAdmin)
                                <button class="layui-btn layui-btn-small layui-btn-normal layui-btn-danger" onclick="removeAdmin(this,{{ $user->id }})">
                                    取消管理员
                                </button>
                                @else
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="addAdmin(this,{{ $user->id }})">
                                    添加管理员
                                </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </fieldset>
    <script type="text/javascript">
        function addAdmin(obj,id) {
            $.ajax({
                url:'/admin/user/'+id+'/admin',
                type:'post',
                dataType:'json',
                success:function (res) {
                    if (res == 1 ){
                        var target = $(obj);
                        target.text('取消管理员');
                        target.addClass('layui-btn-danger');
                        target.attr('onclick',"removeAdmin(this,"+id+")");
                    }else {
                        layer.msg('请重试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        function removeAdmin(obj,id) {
            $.ajax({
                url:'/admin/user/'+id+'/removeAdmin',
                type:'post',
                dataType:'json',
                success:function (res) {
                    if (res == 1 ){
                        var target = $(obj);
                        target.text('添加管理员');
                        target.removeClass('layui-btn-danger');
                        target.attr('onclick',"addAdmin(this,"+id+")");
                    }else {
                        layer.msg('请重试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        function gagUser(obj,id) {
            $.ajax({
                url:'/admin/user/'+id+'/gag',
                type:'post',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.addClass('layui-form-checked');
                        target.attr('onclick',"cancelGagUser(this,"+id+")");
                    }
                }
            });
        }
        function cancelGagUser(obj,id) {
            $.ajax({
                url:'/admin/user/'+id+'/cancelGag',
                type:'post',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.removeClass('layui-form-checked');
                        target.attr('onclick',"gagUser(this,"+id+")");
                    }
                }
            });
        }
        function defriendUser(obj,id) {
            $.ajax({
                url:'/admin/user/'+id+'/defriend',
                type:'post',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.addClass('layui-form-checked');
                        target.attr('onclick',"cancelDefriendUser(this,"+id+")");
                    }
                }
            });
        }
        function cancelDefriendUser(obj,id) {
            $.ajax({
                url:'/admin/user/'+id+'/cancelDefriend',
                type:'post',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.removeClass('layui-form-checked');
                        target.attr('onclick',"defriendUser(this,"+id+")");
                    }
                }
            });
        }
    </script>
@endsection