@extends('layouts.main')

@section('container')
    <style>
        #doc-content{
            padding: 10px;
        }
        .editormd-code-toolbar select {
            display: inline-block;
        }
    </style>
    <div class="layui-container">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8 content detail">
                <div class="fly-panel detail-box">
                    <h1>{{ $post->title }}</h1>
                    <div class="fly-detail-info">
                        <!-- <span class="layui-badge">审核中</span>

                        <span class="layui-badge" style="background-color: #999;">未结</span>
                        <!-- <span class="layui-badge" style="background-color: #5FB878;">已结</span> -->
                        <sapn><a class="layui-badge" style="{{ $post->category->tip_style }}">{{ $post->category->name }}</a></sapn>
                        @if($post->is_top == 1)
                        <span class="layui-badge layui-bg-orange">置顶</span>
                        @endif
                        @if($post->is_sticky == 1)
                        <span class="layui-badge layui-bg-red">精帖</span>
                        @endif
                        <div class="fly-admin-box" data-id="123">
                            <span class="layui-btn layui-btn-xs jie-admin" type="del">删除</span>

                            <span class="layui-btn layui-btn-xs jie-admin" type="set" field="stick" is_sop="1">置顶</span>
                            <!-- <span class="layui-btn layui-btn-xs jie-admin" type="set" field="stick" rank="0" style="background-color:#ccc;">取消置顶</span> -->

                            <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" is_sticky="1">加精</span>
                            <!-- <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span> -->
                        </div>
                        <span class="fly-list-nums">
                            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> {{ $post->comments->count() }}</a>
                            <i class="iconfont" title="浏览">&#xe60b;</i> {{ $post->visitors->sum(['clicks']) }}
                        </span>
                    </div>
                    <div class="detail-about">
                        <a class="fly-avatar" href="/user/{{ $post->user->id }}/home">
                            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}">
                        </a>
                        <div class="fly-detail-user">
                            <a href="/user/{{ $post->user->id }}/home" class="fly-link">
                                <cite>{{ $post->user->name }}</cite>
                            </a>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
                            <span style="padding-right: 10px; color: #FF7200">悬赏：{{ $post->reward }}飞吻</span>
                            @if(Auth::id() == $post->user->id)
                            <span class="layui-btn layui-btn-xs jie-admin" type="edit"><a href="/user/post/{{ $post->id }}/edit">编辑此贴</a></span>
                            @endif
                        </div>
                    </div>
                    <div class="detail-body photos">
                        <div id="doc-content">
                            <textarea style="display:none;">{{ $post->content }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="fly-panel detail-box" id="flyReply">
                    <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                        <legend>回帖</legend>
                    </fieldset>

                    @include('home.post.comment')
                    <div class="layui-form layui-form-pane">
                        <form id="replyForm">
                            <div class="layui-form-item layui-form-text">
                                <a name="comment"></a>
                                <!-- 富文本编辑器-->
                                <div id="my-editormd" >
                                    <textarea id="my-editormd-markdown-doc" style="display:none;"></textarea>
                                    <!-- 注意：name属性的值-->
                                    <textarea id="my-editormd-html-code" style="display:none;"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                @login
                                <button class="layui-btn" lay-filter="reply" lay-submit>提交回复</button>
                                @else
                                <button class="layui-btn" type="button"  onclick="layer.msg('请先登录')">提交回复</button>
                                @endlogin
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="layui-col-md4">
                @include('layouts.right')
            </div>

        </div>
    </div>
    <script>
        var testEditor;
        $(function () {
            testEditor = editormd.markdownToHTML("doc-content", {//注意：这里是上面DIV的id
                htmlDecode: "style,script,iframe",
                emoji: true,
                taskList: true,
                tex: true, // 默认不解析
                flowChart: true, // 默认不解析
                sequenceDiagram: true, // 默认不解析
                codeFold: true
            });});
    </script>

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        layui.use(['form'], function(){
            var form = layui.form;
            layer = layui.layer;

            //监听提交
            form.on('submit(reply)', function(){
                var fm = document.getElementById('replyForm');
                var fd = new FormData(fm);
                fd.append('post_id',{{ $post->id }});
                fd.append('user_id',{{ Auth::id() }});
                if($('#my-editormd-markdown-doc').val().length<5){
                    layer.msg('评论至少得5个字符', function(){
                        //关闭后的操作
                    });
                    return false;
                }
                //ajax提交评论
                $.ajax({
                    url:"/user/doComment",
                    type:'post',
                    data:fd,
                    dataType:'json',
                    processData:false,
                    contentType:false,
                    success:function (res) {
                        if(res.error==1){
                            layer.msg(res.msg, {
                                icon: 1
                                ,time: 1000
                                ,shade: 0.1
                            }, function(){
                                //ajax添加评论，暂时不弄
                                window.location.reload();
                            });
                        }else if(res.error == 0){
                            layer.msg(res.msg, {
                                time: 2500
                                ,shade: 0.2
                            });
                        }else {
                            var error = '';
                            if(res.content != undefined){
                                error += res.content+'<br>';
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

        //点赞
        function dozan(obj,id) {
            var target = $(obj);
            //alert(id);
            $.ajax({
                url:'/user/'+id+'/zan',
                type:'get',
                dataType:'json',
                success:function (res) {
                    if(res.error==1){
                        target.addClass('zanok');
                        var zanNum = target.children('span').text();
                        target.children('span').text(parseInt(zanNum)+1);
                        target.attr("onclick","unzan(this,"+id+")");
                    }else{
                        layer.msg(res.msg);
                    }
                }
            });


        }
        //取消赞
        function unzan(obj,id) {
            var target = $(obj);
            $.ajax({
                url:'/user/'+id+'/unzan',
                type:'get',
                dataType:'json',
                success:function (res) {
                    if(res.error==1){
                        target.removeClass('zanok');
                        var zanNum = target.children('span').text();
                        target.children('span').text(parseInt(zanNum)-1);
                        target.attr("onclick","dozan(this,"+id+")");
                    }else{
                        layer.msg(res.msg);
                    }
                }
            });

        }
        
    </script>
    <script>
        //给帖子内容的超链接加上target
        $(function () {
            $('#doc-content a[href]').attr('target','_blank');
        });
    </script>

    @section('js')
        {{-- 创建一个富文本 --}}
        <script type="text/javascript">
            $(function() {
                editormd("my-editormd", {//注意1：这里的就是上面的DIV的id属性值
                    width   : "100%",
                    height  : 640,
                    emoji: true,
                    syncScrolling : "single",
                    tex: true,// 开启科学公式TeX语言支持，默认关闭
                    path    : "{{ asset('/assets/editormd/lib') }}/",//注意2：你的路径
                    saveHTMLToTextarea : true,//注意3：这个配置，方便post提交表单
                    imageUpload : true,
                    imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                    imageUploadURL : "/user/uploadImg",//注意你后端的上传图片服务地址

                });
            });
        </script>

        <script src="{{ asset('/assets/editormd/lib/marked.min.js') }}"></script>
        <script src="{{ asset('/assets/editormd/lib/prettify.min.js') }}"></script>
        <script src="{{ asset('/assets/editormd/lib/raphael.min.js') }}"></script>
        <script src="{{ asset('/assets/editormd/lib/underscore.min.js') }}"></script>
        <script src="{{ asset('/assets/editormd/lib/sequence-diagram.min.js') }}"></script>
        <script src="{{ asset('/assets/editormd/lib/flowchart.min.js') }}"></script>
        <script src="{{ asset('/assets/editormd/lib/jquery.flowchart.min.js') }}"></script>
        <script src="{{ asset('/assets/editormd/editormd.js') }}"></script>
        
    @endsection

@endsection