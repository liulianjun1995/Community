@extends('layouts.main')

@section('container')
  
  <div class="layui-container fly-marginTop">
    <div class="fly-panel" pad20 style="padding-top: 5px;">
      <!--<div class="fly-none">没有权限</div>-->
      <div class="layui-form layui-form-pane">
        <div class="layui-tab layui-tab-brief" lay-filter="user">
          <ul class="layui-tab-title">
            <li class="layui-this">发表新帖<!-- 编辑帖子 --></li>
          </ul>
          <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
            <div class="layui-tab-item layui-show">
              <form id="addForm">
                <div class="layui-row layui-col-space15 layui-form-item">
                  <div class="layui-col-md3">
                    <label class="layui-form-label">所在专栏</label>
                    <div class="layui-input-block">
                      <select lay-verify="required" name="category" lay-filter="column">
                        <option></option>
                        @foreach($categorys as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="layui-col-md9">
                    <label for="L_title" class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                      <input type="text" id="L_title" name="title" required lay-verify="title" autocomplete="off" class="layui-input">
                    <!-- <input type="hidden" name="id" value=""> -->
                    </div>
                  </div>
                </div>
                <div class="layui-form-item layui-form-text">
                  <div class="layui-input-block">
                    <textarea id="L_content" name="content"  placeholder="详细描述" lay-verify="content" class="layui-textarea fly-editor" style="height: 260px;"></textarea>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">悬赏飞吻</label>
                    <div class="layui-input-inline" style="width: 190px;">
                      <select name="reward">
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="60">60</option>
                        <option value="80">80</option>
                      </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">发表后无法更改飞吻</div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <button class="layui-btn" lay-filter="addPost" lay-submit>立即发布</button>
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


      layui.use(['form','layedit'], function(){
          var form = layui.form;
              layer = layui.layer;
              layedit = layui.layedit;

          var edit = layedit.build('L_content',{  //建立编辑器
              uploadImage:{
                  url:"{{ url('/user/uploadImg') }}",
                  type:'post'
              }
          });

          //自定义验证规则
          form.verify({
              title: function(value){
                  if(value.length < 5){
                      return '标题至少得5个字符啊';
                  }
              },
          });

          //监听提交
          form.on('submit(addPost)', function(){

              var content = layedit.getContent(edit); //获取textarea的内容，带HTML标签
              //alert(content);
              //var content = layedit.getText(edit); //获取编辑器纯文本内容，不带HTML
              if(layedit.getText(edit).length<10){
                  layer.msg('内容至少得10个字符啊', function(){

                  });
                  return false;
              }
              var fm = document.getElementById('addForm');
              var fd = new FormData(fm);
              fd.append('content',content); //将textarea的内容添加到formData

              //ajax校验登录用户
              $.ajax({
                  url:"/post",
                  type:'post',
                  data:fd,
                  processData:false,
                  contentType:false,
                  success:function (res) {
                      if(res==1){
                          layer.msg('发布成功', {
                              icon: 1
                              ,time: 1000
                              ,shade: 0.1
                          }, function(){
                              window.location.href="/";
                          });
                      }else {
                          var error = '';
                          if(res.category != undefined){
                              error += res.category+'<br>';
                          }
                          if(res.title != undefined){
                              error += res.title+'<br>';
                          }
                          if(res.content != undefined){
                              error += res.content+'<br>';
                          }
                          if(res.reward != undefined){
                              error += res.reward+'<br>';
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
