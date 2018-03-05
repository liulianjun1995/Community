@extends('layouts.main')

@section('container')
    <div class="layui-container fly-marginTop">
        <div class="fly-panel fly-panel-user" pad20>
            <div class="layui-tab layui-tab-brief" lay-filter="user">
                <ul class="layui-tab-title">
                    <li><a href="/user/login">登入</a></li>
                    <li class="layui-this">注册</li>
                </ul>
                <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-form layui-form-pane">
                            <form method="post" id="regForm">
                                <div class="layui-form-item">
                                    <label for="L_email" class="layui-form-label">邮箱</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="L_email" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名</div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="L_username" class="layui-form-label">昵称</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="L_username" name="name" required lay-verify="required" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="L_pass" class="layui-form-label">密码</label>
                                    <div class="layui-input-inline">
                                        <input type="password" id="L_pass" name="password" required lay-verify="password" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="L_repass" class="layui-form-label">确认密码</label>
                                    <div class="layui-input-inline">
                                        <input type="password" id="L_repass" name="password_confirmation" required lay-verify="repassword" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label for="L_vercode" class="layui-form-label">人类验证</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid">
                                        <span style="color: #c00;"></span>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <button class="layui-btn" lay-filter="reg" lay-submit>立即注册</button>
                                </div>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="layui-form-item fly-form-app">
                                    <span>或者直接使用社交账号快捷注册</span>
                                    <a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>
                                    <a href="" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            layui.use(['form', 'layedit', 'laydate'], function(){
                var form = layui.form
                    ,layer = layui.layer

                //自定义验证规则
                form.verify({
                    password: [/(.+){6,12}$/, '密码必须6到12位']
                    ,repassword:[/(.+){6,12}$/, '密码必须6到12位']
                });

                //监听提交
                form.on('submit(reg)', function(){
                    var password = document.getElementById('L_pass').value;
                    var repassword = document.getElementById('L_repass').value;

                    if  (password != repassword){
                        layer.msg('两次输入的密码不一致',{time:2000, shift: 6,icon:5});
                        return false;
                    }

                    var fm = document.getElementById('regForm');

                    var fd = new FormData(fm);

                    $.ajax({
                        url:"/user/reg",
                        type:'post',
                        dataType:'json',
                        data:fd,
                        processData:false,
                        contentType:false,
                        success:function (res) {
                            if(res==1){
                                layer.msg('注册成功', {
                                    icon: 1
                                    ,time: 1000
                                    ,shade: 0.1
                                }, function(){
                                    window.location.href="/";
                                });
                            }else if (res == 1){
                                layer.msg('注册失败，请重新操作', {
                                    icon: 2
                                    ,time: 1000
                                    ,shade: 0.1
                                }, function(){

                                });
                            }else {
                                var error = '';
                                if(res.name != undefined){
                                    error += res.name+'<br>';
                                }
                                if(res.email != undefined){
                                    error += res.email+'<br>';
                                }
                                if(res.password != undefined){
                                    error += res.password+'<br>';
                                }
                                layer.msg(error, {
                                    time: 2500
                                    ,shade: 0.2
                                });
                            }
                        },
                        error:function () {
                            layer.msg('请求失败，请重试', function(){
                                //关闭后的操作
                            });
                        }

                    });
                    event.preventDefault();

                });
            });
        </script>
@endsection