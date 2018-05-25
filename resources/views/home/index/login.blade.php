@extends('layouts.main')

@section('container')
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <script>
                layer.msg('{{ $error }}', {
                    time: 1000
                    ,shade: 0.2
                });
            </script>
        @endforeach
    @endif
  <div class="layui-container fly-marginTop">
    <div class="fly-panel fly-panel-user" pad20>
      <div class="layui-tab layui-tab-brief" lay-filter="user">
        <ul class="layui-tab-title">
          <li class="layui-this">登入</li>
          <li><a href="/user/reg">注册</a></li>
        </ul>
        <div class="layui-form layui-tab-content"  style="padding: 20px 0;">
          <div class="layui-tab-item layui-show">
            <div class="layui-form layui-form-pane">
              <form method="post" id="loginForm">
                <div class="layui-form-item">
                  <label for="L_email" class="layui-form-label">邮箱/手机</label>
                  <div class="layui-input-inline">
                    <input type="text" id="login" name="login" lay-verify="login" autocomplete="off" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label for="L_pass" class="layui-form-label">密码</label>
                  <div class="layui-input-inline">
                    <input type="password" name="password" required lay-verify="password" autocomplete="off" class="layui-input">
                  </div>
                </div>
              <div class="layui-form-item">
                  <label for="L_vercode" class="layui-form-label">验证码</label>
                  <div class="layui-input-inline">
                      <input type="text" id="captcha" type="captcha" name="captcha" required lay-verify="captcha" placeholder="请输入验证码" autocomplete="off" class="layui-input">
                  </div>
                  <div class="layui-form-mid" style="bottom: 10px;">
                      <span class="col-md-1 refereshrecapcha"  onclick="refreshCaptcha()">
                        {!! captcha_img('default')  !!}
                      </span>
                  </div>
              </div>
                <div class="layui-form-item">
                  <button class="layui-btn" lay-filter="login" lay-submit>立即登录</button>
                  <span style="padding-left:20px;">
                  <a href="forget.html">忘记密码？</a>
                </span>
                </div>
              <div class="layui-form-item fly-form-app">
                  <span>或者使用社交账号登入</span>
                  <a href="/github" onclick="layer.msg('正在通过GitHub登入', {icon:16, shade: 0.1, time:0})" class="icon-github" title="GitHub登入"></a>
              </div>
              </form>
            </div>
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
              password: [/(.+){6,12}$/, '密码必须6到12位'],
              login: [/(^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$)|(^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$)/,'请输入正确的邮箱或手机号'],
          });

          //监听提交
          form.on('submit(login)', function(){
              var fm = document.getElementById('loginForm');
              var fd = new FormData(fm);

              //ajax校验登录用户
              $.ajax({
                  url:"/user/login",
                  type:'post',
                  dataType:'json',
                  data:fd,
                  processData:false,
                  contentType:false,
                  success:function (res) {
                      if(res.error==1){
                          layer.msg(res.msg, {
                              icon: 1
                              ,time: 1000
                              ,shade: 0.1
                          }, function(){
                              window.location.href="/";
                          });
                      }else {
                          layer.msg(res.msg, {
                              icon: 2
                              ,time: 1000
                              ,shade: 0.2
                          });
                      }
                  },
                  error:function (res) {
                      var error = '';
                      if (res.responseJSON.errors.captcha != undefined){
                          error += res.responseJSON.errors.captcha+"<br>";
                      }
                      if (res.responseJSON.errors.login != undefined){
                          error += res.responseJSON.errors.login;
                      }
                      if (res.responseJSON.errors.password != undefined){
                          error += res.responseJSON.errors.password;
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