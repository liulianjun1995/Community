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
                        <sapn><a class="layui-badge" style="{{ $post->category->tip_style }}">{{ $post->category->name }}</a></sapn>
                        @if($post->is_closed == 0)
                        <span class="layui-badge" style="background-color: #999;">未结</span>
                        @else
                        <span class="layui-badge" style="background-color: #5FB878;">已结</span>
                        @endif
                        @if($post->is_top == 1)
                        <span class="layui-badge layui-bg-orange">置顶</span>
                        @endif
                        @if($post->is_sticky == 1)
                        <span class="layui-badge layui-bg-red">精帖</span>
                        @endif
                        <div class="fly-admin-box" data-id="123">
                            @can('post')
                                @if($post->is_top ==0)
                                <span class="layui-btn layui-btn-xs jie-admin " onclick="setTop(this,{{ $post->id }})">置顶</span>
                                @elseif($post->is_top == 1)
                                <span class="layui-btn layui-btn-xs jie-admin layui-bg-orange" onclick="cancelTop(this,{{ $post->id }})">取消置顶</span>
                                @endif
                                @if($post->is_sticky ==0)
                                <span class="layui-btn layui-btn-xs jie-admin" onclick="setSticky(this,{{ $post->id }})">加精</span>
                                @elseif($post->is_sticky == 1)
                                <span class="layui-btn layui-btn-xs jie-admin layui-bg-red" onclick="cancelSticky(this,{{ $post->id }})">取消加精</span>
                                @endif
                            @endcan
                            @if($post->user->id == Auth::id())
                                <span class="layui-btn layui-btn-xs jie-admin" type="del" onclick="delPost({{ $post->id }},{{ $post->user->id }})">删除</span>
                            @else
                                @can('post')
                                <span class="layui-btn layui-btn-xs jie-admin" type="del" onclick="delPostByAdmin({{ $post->id }},{{ $post->user->id }})">删除</span>
                                @endcan
                            @endif
                        </div>
                        <span class="fly-list-nums">
                            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> {{ $post->comments->count() }}</a>
                            <i class="iconfont" title="浏览">&#xe60b;</i> {{ $post->visitors->sum(['clicks']) }}
                        </span>
                    </div>
                    <div class="detail-about">
                        <a class="fly-avatar" href="/user/{{ $post->user->id }}/home">
                            @if(\App\Model\UserUseGoods::where('user_id',$post->user->id)->where('type_id','6')->get()->count())
                                <img src="{{ \App\Model\Goods::where('id',\App\Model\UserUseGoods::where('type_id','6')->first()['goods_id'])->first()['img'] }}" style="display: inline-block;position:absolute;margin-top: -10px" draggable="false">
                            @endif
                            <img src="{{ $post->user->avatar }}" style="border-radius: 45px" alt="{{ $post->user->name }}">
                        </a>
                        <div class="fly-detail-user">
                            <a href="/user/{{ $post->user->id }}/home" class="fly-link">
                                <cite>{{ $post->user->name }}@admin <span style="color:#c00;">（管理员）</span>@endadmin</cite>
                            </a>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
                            <span style="padding-right: 10px; color: #FF7200">悬赏：{{ $post->reward }}飞吻</span>
                            @if(Auth::id() == $post->user->id)
                            <span class="layui-btn layui-btn-xs jie-admin" type="edit"><a href="/user/post/{{ $post->id }}/edit">编辑此贴</a></span>
                            @endif
                            @login
                                @if($post->savePost(Auth::id())->exists())
                                <span class="layui-btn layui-btn-xs jie-admin layui-btn-danger" type="save" onclick="unsavePost(this,{{ $post->id }})">取消收藏</span>
                                @else
                                <span class="layui-btn layui-btn-xs jie-admin" type="save" onclick="savePost(this,{{ $post->id }})">收藏</span>
                                @endif
                            @else
                                <span class="layui-btn layui-btn-xs jie-admin" type="save" onclick="layer.msg('请先登录')">收藏</span>
                            @endlogin
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
                        <legend>评论</legend>
                    </fieldset>
                    @include('home.post.comment')
                </div>
            </div>

            <div class="layui-col-md4">
                @include('layouts.recommendation')
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

                        });
                    }
                });
                event.preventDefault();
            });
        });
        //收藏
        function savePost(obj,post_id) {
            var target = $(obj);
            $.ajax({
                url:'/user/savePost',
                type:'post',
                data:{'post_id':post_id},
                dataType:'json',
                success:function (res) {
                    if(res.error == 0){
                        target.text('取消收藏');
                        target.addClass('layui-btn-danger');
                        target.attr('onclick',"unsavePost(this,"+post_id+")");
                    }else {
                        layer.msg('收藏失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        //取消收藏
        function unsavePost(obj,post_id) {
            var target = $(obj);
            $.ajax({
                url:'/user/unsavePost',
                type:'post',
                data:{'post_id':post_id},
                dataType:'json',
                success:function (res) {
                    if(res.error == 0){
                        target.text('收藏');
                        target.removeClass('layui-btn-danger');
                        target.attr('onclick',"savePost(this,"+post_id+")");
                    }else {
                        layer.msg('取消收藏失败，请稍后再试')
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        //删除帖子
        function delPost(post_id,user_id) {
            layer.confirm('确定删除吗？', {
                btn: ['是','否'] //按钮
            }, function(){
                $.ajax({
                    url:"/user/post/"+post_id,
                    type:"post",
                    method:"DELETE",
                    data:{'user_id':user_id},
                    dataType:'json',
                    success:function (res) {
                        if (res.error == 0){
                            layer.msg(res.msg);
                            setTimeout("window.location.href='/';",2000);
                        }else {
                            layer.msg(res.msg);
                        }
                    },
                    error:function () {
                        layer.msg('请求失败，请稍后再试');
                    }
                });

            }, function(){

            });
        }
        //置顶
        function setTop(obj,post_id) {
            $.ajax({
                url:"/post/"+post_id+'/setTop',
                type:"post",
                dataType:'json',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.text('取消置顶');
                        target.addClass('layui-bg-orange');
                        target.attr('onclick',"cancelTop(this,"+post_id+")");
                    }else{
                        layer.msg('请求失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        //取消置顶
        function cancelTop(obj,post_id) {
            $.ajax({
                url:"/post/"+post_id+'/cancelTop',
                type:"post",
                dataType:'json',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.text('置顶');
                        target.removeClass('layui-bg-orange');
                        target.attr('onclick',"setTop(this,"+post_id+")");
                    }else{
                        layer.msg('请求失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        //加精
        function setSticky(obj,post_id) {
            $.ajax({
                url:"/post/"+post_id+'/setSticky',
                type:"post",
                dataType:'json',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.text('取消加精');
                        target.addClass('layui-bg-red');
                        target.attr('onclick',"cancelSticky(this,"+post_id+")");
                    }else{
                        layer.msg('请求失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        //取消加精
        function cancelSticky(obj,post_id) {
            $.ajax({
                url:"/post/"+post_id+'/setSticky',
                type:"post",
                dataType:'json',
                success:function (res) {
                    if (res == 1){
                        var target = $(obj);
                        target.text('加精');
                        target.removeClass('layui-bg-red');
                        target.attr('onclick',"setSticky(this,"+post_id+")");
                    }else{
                        layer.msg('请求失败，请稍后再试');
                    }
                },
                error:function () {
                    layer.msg('请求失败，请稍后再试');
                }
            });
        }
        //删除
        function delPostByAdmin(post_id,user_id) {
            layer.confirm('确定删除吗？', {
                btn: ['是','否'] //按钮
            }, function(){
                $.ajax({
                    url:"/post/"+post_id+'/del',
                    type:"post",
                    data:{'user_id':user_id},
                    dataType:'json',
                    success:function (res) {
                        if (res.error == 0){
                            layer.msg(res.msg);
                            setTimeout("window.location.href='/';",2000);
                        }else {
                            layer.msg(res.msg);
                        }
                    },
                    error:function () {
                        layer.msg('请求失败，请稍后再试');
                    }
                });

            }, function(){

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