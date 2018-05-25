@extends('admin.layouts.main')
@section('content')
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;">
        <legend id="articleBoxTitle" style="text-align: center">添加权限</legend>
        <div class="layui-field-box">
            <div id="articleContent" class="">
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
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="addPermission">添加</button>
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
                    if (value.length < 2){
                        return '权限名称至少得2个字符';
                    }
                    if (value.length > 20){
                        return '权限名称最多20个字符';
                    }
                },
                description:function (value) {
                    if (value.length < 4){
                        return '权限描述至少得4个字符';
                    }
                    if (value.length > 50){
                        return '权限描述最对50个字符';
                    }
                }
            });
            //监听提交
            form.on('submit(addPermission)', function(data){
                var fm = document.getElementById('createForm');
                var fd = new FormData(fm);
                $.ajax({
                    url:'/admin/permission/store',
                    type:'post',
                    data:fd,
                    processData:false,
                    contentType:false,
                    success:function (res) {
                        if (res.error == 0){
                            layer.msg(res.msg, {
                                icon: 1
                                ,time: 1000
                                ,shade: 0.1
                            }, function(){
                                window.location.href = '/admin/permissionList';
                            });
                        }else {
                            layer.msg(res.msg, {
                                icon: 1
                                ,time: 1000
                                ,shade: 0.1
                            }, function(){
                                window.location.href = '/admin/permissionList';
                            });
                        }
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