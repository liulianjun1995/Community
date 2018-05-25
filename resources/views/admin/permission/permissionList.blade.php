@extends('admin.layouts.main')
@section('content')
    <fieldset id="articleConsole" class="layui-elem-field layui-field-title" style="display:block;text-align: center">
        <legend>控制台</legend>
        <div class="layui-field-box">
            <div id="articleIndexTop">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item" style="margin:0;margin-top:15px;">
                        <div class="layui-inline">
                            <div class="layui-input-inline" style="width:auto">
                                <a href="{{ url('/admin/permission/create') }}" class="layui-btn layui-btn-normal">添加权限</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;text-align: center">
        <legend id="articleBoxTitle">权限列表</legend>
        <div class="layui-field-box" >
            <div>
                <table style="width: auto;margin: 0 auto" class="layui-table">
                    <colgroup>
                        <col width="80">
                        <col width="100">
                        <col width="200">
                        <col width="50">
                        <col width="50">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>名称</th>
                        <th>描述</th>
                        <th colspan="2">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->description}}</td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="window.location.href='/admin/permission/{{$permission->id}}/edit'">
                                    修改
                                </button>
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="delPermission(this,{{ $permission->id }})">
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

        function delPermission(obj,id) {
            layer.confirm('是否删除？', {
                btn: ['是','否'] //按钮
            }, function(){
                //删除
                $.ajax({
                    url:'/admin/permission/'+id+'/delete',
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