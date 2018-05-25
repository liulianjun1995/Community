@extends('admin.layouts.main')
@section('content')
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;">
        <legend id="articleBoxTitle" style="text-align: center">修改商品种类</legend>
        <div class="layui-field-box">
            <div>
                <form id="createForm" class="layui-form form-main" style="width:70%;margin: 0 auto;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">种类名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" value="{{ $type->name }}" lay-verify="name" placeholder="请输入种类名称" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="editType">添加</button>
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
                        return '种类名称至少2个字符';
                    }
                    if (value.length > 10){
                        return '角色名称最多10个字符';
                    }
                },

            });
            //监听提交
            form.on('submit(editType)', function(data){
                var fm = document.getElementById('createForm');
                var fd = new FormData(fm);

                $.ajax({
                    url:'/admin/goodsType/{{ $type->id }}/update',
                    type:'post',
                    data:fd,
                    processData:false,
                    contentType:false,
                    success:function (res) {
                        if (res == 1){
                            layer.msg('修改成功', {
                                icon: 1
                                ,time: 1000
                                ,shade: 0.1
                            }, function(){
                                window.location.href = '/admin/goodsTypeList';
                            });
                        }else{
                            layer.msg('修改失败，请重试', {
                                time: 2500
                                ,shade: 0.2
                            });
                        }
                    },
                    error:function (res) {
                        var error = '';
                        if (res.responseJSON.errors.name != undefined){
                            error += res.responseJSON.errors.name+"<br>";
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