@extends('admin.layouts.main')
@section('content')
    <!-- layui.css -->
    <fieldset id="articleConsole" class="layui-elem-field layui-field-title" style="display:block;text-align: center">
        <legend>控制台</legend>
        <div class="layui-field-box">
            <div id="articleIndexTop">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item" style="margin:0;margin-top:15px;">
                        <div class="layui-inline">
                            <div class="layui-input-inline" style="width:auto">
                                <a href="{{ url('/admin/role/create') }}" class="layui-btn layui-btn-normal">添加角色</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;text-align: center">
        <legend id="articleBoxTitle">黑名单列表</legend>
        <div class="layui-field-box">
            <div id="articleContent" class="">
                <table style="width: auto;margin: 0 auto" class="layui-table" lay-even="">
                    <colgroup>
                        <col width="80">
                        <col width="80">
                        <col width="200">
                        <col width="10">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>用户id</th>
                        <th>用户名</th>
                        <th>拉黑时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($defriendUsers as $defriendUser)
                        <tr>
                            <td>{{$defriendUser->user->id}}</td>
                            <td>{{$defriendUser->user->name}}</td>
                            <td>{{$defriendUser->created_at}}</td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="delDefriendUser(this,{{ $defriendUser->id }})">
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
        layui.use(['layer'],function () {
            var layer = layui.layer;
        });
        function delDefriendUser(obj,id) {
            $.ajax({
                url:'/admin/user/'+id+'/cancelDefriend',
                type:'post',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.parent().parent().remove();
                    }
                }
            });
        }

    </script>
@endsection