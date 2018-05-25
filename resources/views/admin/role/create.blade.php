@extends('admin.layouts.main')
@section('content')
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;">
        <legend id="articleBoxTitle" style="text-align: center">添加角色</legend>
        <div class="layui-field-box">
            <div>
                <form id="createForm" class="layui-form form-main" style="width:70%;margin: 0 auto;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name"  lay-verify="name" placeholder="请输入权限名称" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="description" lay-verify="description" placeholder="请输入权限描述" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">权限</label>
                        <div class="layui-input-block">
                            @foreach($permissions as $permission)
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" title="{{ $permission->name }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="addRole">添加</button>
                            <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.go(-1)">返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        layui.use(['form'],function () {
            var form  = layui.form;
            form.verify({
                name:function (value) {
                    if (value.length < 5){
                        return '角色名称至少5个字符';
                    }
                    if (value.length > 20){
                        return '角色名称最多20个字符';
                    }
                },
                description:function (value) {
                    if (value.length < 4){
                        return '角色描述至少得4个字符';
                    }
                    if (value.length > 20){
                        return '角色描述最多20个字符';
                    }
                }
            });
            //监听提交
            form.on('submit(addRole)', function(data){
                var fm = document.getElementById('createForm');
                var fd = new FormData(fm);
                //验证复选框
                var cbs = $("input[type='checkbox']");
                var checkNum = 0;
                for (var i = 0; i < cbs.length; i++) {
                    if (cbs[i].checked) {
                        checkNum++;
                    }
                }
                if (checkNum == 0) {
                    layer.msg('请至少选中一个权限', function(){
                    });
                    return false;
                }

                $.ajax({
                    url:'/admin/role/store',
                    type:'post',
                    data:fd,
                    processData:false,
                    contentType:false,
                    success:function () {
                        window.location.href = '/admin/roleList';
                    },
                    error:function (res) {
                        var error = '';
                        if (res.responseJSON.errors.name != undefined){
                            error += res.responseJSON.errors.name+"<br>";
                        }
                        if (res.responseJSON.errors.description != undefined){
                            error += res.responseJSON.errors.description;
                        }
                        layer.msg(error, {
                            time: 2500
                            ,shade: 0.2
                        });
                    }
                });
                return false;
            });
        });

    </script>
@endsection