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
        <legend id="articleBoxTitle">管理员列表</legend>
        <div class="layui-field-box">
            <div id="articleContent" class="">
                <table style="width: auto;margin: 0 auto" class="layui-table" lay-even="">
                    <colgroup>
                        <col width="80">
                        <col width="100">
                        <col width="80">
                        <col width="120">
                        <col width="180">
                        <col width="180">
                        <col width="180">
                        <col width="80">
                        <col width="80">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>用户id</th>
                        <th>用户名</th>
                        <th>性别</th>
                        <th>手机号</th>
                        <th>邮箱</th>
                        <th>添加时间</th>
                        <th>选项</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td>{{$admin->user->id}}</td>
                            <td>{{$admin->user->name}}</td>
                            <td>{{$admin->user->sex}}</td>
                            <td>{{$admin->user->phone}}</td>
                            <td>{{ $admin->user->email }}</td>
                            <td>{{ $admin->created_at }}</td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="window.location.href='/admin/adminUser/{{ $admin->id }}/role'">
                                    角色管理
                                </button>
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="removeAdmin(this,{{ $admin->user->id }})">
                                    删除
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

        function removeAdmin(obj,id) {
            layer.confirm('是否删除？', {
                btn: ['是','否'] //按钮
            }, function(){
                //删除
                $.ajax({
                    url:'/admin/user/'+id+'/removeAdmin',
                    type:'post',
                    dataType:'json',
                    success:function (res) {
                        if(res == 1){
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
    </script>
@endsection