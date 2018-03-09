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
                  <label for="L_email" class="layui-form-label">邮箱</label>
                  <div class="layui-input-inline">
                    <input type="text" id="L_email" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label for="L_pass" class="layui-form-label">密码</label>
                  <div class="layui-input-inline">
                    <input type="password" id="L_pass" name="password" required lay-verify="password" autocomplete="off" class="layui-input">
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
                  <a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>
                  <a href="" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a>
                </div>
              </form>
            </div>
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
      layui.use(['form'], function(){
          var form = layui.form
              ,layer = layui.layer

          //自定义验证规则
          form.verify({
              password: [/(.+){6,12}$/, '密码必须6到12位']
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
                              time: 1000
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