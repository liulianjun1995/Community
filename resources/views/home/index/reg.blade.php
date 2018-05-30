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
                                    <div class="layui-form-mid layui-word-aux">您的登入名</div>
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
                                    <label for="L_vercode" class="layui-form-label">验证码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="captcha" type="captcha" name="captcha" required placeholder="请输入验证码" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid" style="bottom: 10px;">
                                      <span class="col-md-1 refereshrecapcha" onclick="refreshCaptcha()">
                                        {!! captcha_img('default')  !!}
                                      </span>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            //刷新验证码
            function refreshCaptcha(){
                $.ajax({
                    url: "/refereshcapcha",
                    type: 'get',
                    dataType: 'html',
                    success: function(json) {
                        $('.refereshrecapcha').html(json);
                    },
                    error: function(data) {
                        alert('再试一次');
                    }
                });
            }
            layui.use(['form'], function(){
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
                    //验证两次密码
                    if  (password != repassword){
                        layer.msg('两次输入的密码不一致',{time:2000, shift: 6,icon:5});
                        return false;
                    }
                    //FormData
                    var fm = document.getElementById('regForm');
                    var fd = new FormData(fm);
                    //异步提交
                    $.ajax({
                        url:"/user/reg",
                        type:'post',
                        dataType:'json',
                        data:fd,
                        processData:false,
                        contentType:false,
                        success:function (res) {
                            if(res == 1){
                                layer.msg('注册成功,请前往邮箱激活账户！', {
                                    icon: 1
                                    ,time: 1000
                                    ,shade: 0.1
                                }, function(){
                                    window.location.href="/";
                                });
                            }else if (res == 0){
                                layer.msg('注册失败，请重新操作', {
                                    icon: 2
                                    ,time: 1000
                                    ,shade: 0.1
                                }, function(){
                                    refreshCaptcha();
                                });
                            }else {
                                layer.msg('请求失败，请重试', {
                                    icon: 2
                                    ,time: 1000
                                    ,shade: 0.1
                                }, function(){
                                    refreshCaptcha();
                                });
                            }
                        },
                        error:function (res) {
                            console.log(res);
                            var error = '';
                            if(res.responseJSON.errors.name != undefined){
                                error += res.responseJSON.errors.name+'<br>';
                            }
                            if(res.responseJSON.errors.email != undefined){
                                error += res.responseJSON.errors.email+'<br>';
                            }
                            if(res.responseJSON.errors.password != undefined){
                                error += res.responseJSON.errors.password+'<br>';
                            }
                            if(res.responseJSON.errors.captcha != undefined){
                                error += res.responseJSON.errors.captcha;
                            }
                            layer.msg(error, {
                                time: 2500
                                ,shade: 0.2
                            });
                            refreshCaptcha();
                        }

                    });
                    event.preventDefault();
                });
            });
        </script>
@endsection