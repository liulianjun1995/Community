@extends('layouts.main')
@section('container')
    @if(count($errors) > 0)
            <script>
                var error = "";
                @foreach($errors->all() as $error)
                 error += '{{ $error }}'+"<br>";
                @endforeach
                layer.msg(error, {
                    time: 3000
                    ,shade: 0.2
                });
            </script>
    @endif
    <div class="layui-container fly-marginTop fly-user-main">
        @include('home.user.main')
        <div class="fly-panel fly-panel-user">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title" id="LAY_mine">
                    <li class="layui-this">绑定手机号</li>
                </ul>
                <div class="layui-tab-content" style="padding: 20px 0;">
                    {{-- 密码 --}}
                    <div class="layui-form layui-form-pane layui-tab-item layui-show">
                        <form method="post" action="/user/bindPhone">
                            {{ csrf_field() }}
                            <div class="layui-form-item">
                                <label for="phone" class="layui-form-label">手机号</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="phone" name="phone" required lay-verify="required|phone" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="phone" class="layui-form-label">验证码</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="verifyCode" name="verifyCode" lay-verify="required|verifyCode" autocomplete="off" class="layui-input">
                                </div>
                                <div><button class="layui-btn" type="button" id="sendVerifySmsButton">发送验证码</button></div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" lay-filter="bindPhone" lay-submit>确认修改</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use('form', function(){
            var form = layui.form;

            //自定义验证规则
            form.verify({
                verifyCode:[/^\d{5}$/,'验证码必须是5个数字']
            });

            //监听提交
            form.on('submit(bindPhone)', function(){

            });

        });
    </script>
    <script src="{{ asset('/assets/js/laravel-sms.js') }}"></script>
    <script>
        $("#sendVerifySmsButton").sms({
            //laravel csrf token
            token: "{{ csrf_token() }}",
            //请求间隔时间
            interval    : 60,
            //请求参数
            requestData : {
                //手机号
                mobile : function () {
                    return $('input[name=phone]').val();
                },
                //手机号的检测规则
                mobile_rule : 'mobile_required'
            },
            //消息展示方式(默认为alert)
            notify      : function (msg, type) {
                layer.msg(msg);
            },
        });
    </script>
@endsection