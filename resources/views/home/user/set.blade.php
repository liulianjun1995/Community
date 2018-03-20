@extends('layouts.main')

@section('container')
  <div class="layui-container fly-marginTop fly-user-main">
  @include('home.user.main')
  <div class="fly-panel fly-panel-user">
    <div class="layui-tab layui-tab-brief">
      <ul class="layui-tab-title" id="LAY_mine">
        <li class="layui-this">我的资料</li>
        <li>头像</li>
        <li>密码</li>
        <li>帐号绑定</li>
      </ul>
      <div class="layui-tab-content" style="padding: 20px 0;">
        {{-- 我的资料 --}}
        <div class="layui-form layui-form-pane layui-tab-item layui-show">
          <form id="infoForm">
            <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">邮箱</label>
              <div class="layui-input-inline">
                <input type="text" id="L_email" name="email" required readonly lay-verify="email" autocomplete="off" value="{{ Auth::user()->email }}" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">如果您在邮箱已激活的情况下，变更了邮箱，需<a href="activate.html" style="font-size: 12px; color: #4f99cf;">重新验证邮箱</a>。</div>
            </div>
            <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">昵称</label>
              <div class="layui-input-inline">
                <input type="text" id="L_username" name="name" required lay-verify="required" autocomplete="off" value="{{ Auth::user()->name }}" class="layui-input">
              </div>
              <div class="layui-inline">
                <div class="layui-input-inline">
                  <input type="radio" name="sex" value="1" title="男" @if(Auth::user()->sex == '男') checked @endif>
                  <input type="radio" name="sex" value="2" title="女" @if(Auth::user()->sex == '女') checked @endif>
                </div>
              </div>
            </div>
            <div class="layui-form-item">
              <label for="L_city" class="layui-form-label">城市</label>
              <div class="layui-input-inline">
                <input type="text" id="L_city" name="city" autocomplete="off" value="" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <label for="L_sign" class="layui-form-label">签名</label>
              <div class="layui-input-block">
                <textarea placeholder="随便写些什么刷下存在感" id="L_sign"  name="sign" autocomplete="off" class="layui-textarea" style="height: 80px;">{{ Auth::user()->sign }}</textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <button class="layui-btn" type="button" onclick="changeInfo()">确认修改</button>
            </div>
          </form>
        </div>
        {{-- 头像 --}}
        <div class="layui-form layui-form-pane layui-tab-item">
          <div class="layui-form-item">
            <div class="avatar-add">
              <p>建议尺寸168*168，支持jpg、png、gif，最大不能超过50KB</p>
              <button type="button" class="layui-btn upload-img">
                <i class="layui-icon">&#xe67c;</i>上传头像
              </button>
              <img class="img-upload-view" src="{{ Auth::user()->avatar }}">
              <span class="loading"></span>
            </div>
          </div>
        </div>
        {{-- 密码 --}}
        <div class="layui-form layui-form-pane layui-tab-item">
          <form action="/user/repass" method="post">
            <div class="layui-form-item">
              <label for="L_nowpass" class="layui-form-label">当前密码</label>
              <div class="layui-input-inline">
                <input type="password" id="L_nowpass" name="nowpass" required lay-verify="required" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">新密码</label>
              <div class="layui-input-inline">
                <input type="password" id="L_pass" name="password" required lay-verify="required" autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">6到16个字符</div>
            </div>
            <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">确认密码</label>
              <div class="layui-input-inline">
                <input type="password" id="L_repass" name="repass" required lay-verify="required" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <button class="layui-btn" type="submit">确认修改</button>
            </div>
          </form>
        </div>
        {{-- 帐号绑定 --}}
        <div class="layui-form layui-form-pane layui-tab-item">
          <ul class="app-bind">
            <li class="fly-msg app-havebind">
              <i class="iconfont icon-qq"></i>
              <span>已成功绑定，您可以使用QQ帐号直接登录Fly社区，当然，您也可以</span>
              <a href="javascript:;" class="acc-unbind" type="qq_id">解除绑定</a>

              <!-- <a href="" onclick="layer.msg('正在绑定微博QQ', {icon:16, shade: 0.1, time:0})" class="acc-bind" type="qq_id">立即绑定</a>
              <span>，即可使用QQ帐号登录Fly社区</span> -->
            </li>
            <li class="fly-msg">
              <i class="iconfont icon-weibo"></i>
              <!-- <span>已成功绑定，您可以使用微博直接登录Fly社区，当然，您也可以</span>
              <a href="javascript:;" class="acc-unbind" type="weibo_id">解除绑定</a> -->

              <a href="" class="acc-weibo" type="weibo_id"  onclick="layer.msg('正在绑定微博', {icon:16, shade: 0.1, time:0})" >立即绑定</a>
              <span>，即可使用微博帐号登录Fly社区</span>
            </li>
          </ul>
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
      //Demo
      layui.use('form', function(){
            var form = layui.form;
      });
      //根据ip获取城市
      if($('#L_city').val() === ''){
          $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function(){
              $('#L_city').val(remote_ip_info.city||'');
          });
      }
      //修改资料
      function changeInfo(){
          var fm = document.getElementById('infoForm');

          var fd = new FormData(fm);

          $.ajax({
              url:"/user/info",
              type:'post',
              data:fd,
              processData:false,
              contentType:false,
              success:function (res) {
                  if(res ==1 ){
                      layer.msg('修改成功', {
                          icon: 1
                          ,time: 1000
                          ,shade: 0.1
                      }, function(){
                          location.reload();
                      });
                  }else {
                      layer.msg('修改失败', {
                          icon: 2
                          ,time: 1000
                          ,shade: 0.1
                      });
                  }
              },
              error:function () {
                  
              }
              
          });
          event.preventDefault();

      }
      //上传图片
      if($('.upload-img')[0]){
          layui.use('upload', function(upload){
              var avatarAdd = $('.avatar-add');
              var tag_token = $('meta[name="csrf-token"]').attr('content');
              upload.render({
                  elem: '.upload-img'
                  ,type:'images'
                  ,exts: 'jpg|png|gif'
                  ,url: '/user/upload'
                  ,data:{'_token':tag_token}
                  ,before: function(obj){
                      //预读本地文件示例，不支持ie8
                      obj.preview(function(index, file, result){
                          $('.img-upload-view').attr('src', result); //图片链接（base64）
                      });
                  }
                  ,done: function(res){
                      //如果上传失败
                      alert(res);
                      if(res.status == 1){
                          return layer.msg('上传成功');
                      }else{//上传成功
                          layer.msg(res.message);
                      }
                  }
                  ,error: function(){
                      //演示失败状态，并实现重传
                      return layer.msg('上传失败,请重新上传');
                  }

              });
          });
      }
  </script>
@endsection