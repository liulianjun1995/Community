@extends('admin.layouts.main')
@section('content')
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;">
        <legend id="articleBoxTitle" style="text-align: center">赋予角色</legend>
        <div class="layui-field-box">
            <div>
                <form id="addForm" class="layui-form form-main" style="width:70%;margin: 0 auto;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-block">
                            <input type="text" name="name"  lay-verify="name" value="{{ $adminUser->user->name }}" autocomplete="off" class="layui-input" readonly>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">角色</label>
                        <div class="layui-input-block">
                            @foreach($roles as $role)
                                <input type="checkbox" id="{{ $role->name }}" name="roles[]" value="{{ $role->id }}" title="{{ $role->name }}" @if($myRoles->contains($role)) checked  @endif>
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

            //监听提交
            form.on('submit(addRole)', function(){
                var fm = document.getElementById('addForm');
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
                    url:'/admin/adminUser/{{ $adminUser->id }}/assignRole',
                    type:'post',
                    data:fd,
                    processData:false,
                    contentType:false,
                    success:function () {
                        window.location.href = '/admin/adminList';
                    },
                    error:function () {

                        layer.msg('操作失败，请重试', {
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