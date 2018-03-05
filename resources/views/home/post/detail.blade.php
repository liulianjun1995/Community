@extends('layouts.main')

@section('container')
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
                        <span class="layui-badge layui-bg-black">置顶</span>
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
                            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> 66</a>
                            <i class="iconfont" title="人气">&#xe60b;</i> 99999
                        </span>
                    </div>
                    <div class="detail-about">
                        <a class="fly-avatar" href="../user/home.html">
                            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}">
                        </a>
                        <div class="fly-detail-user">
                            <a href="../user/home.html" class="fly-link">
                                <cite>{{ $post->user->name }}</cite>
                            </a>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
                            <span style="padding-right: 10px; color: #FF7200">悬赏：{{ $post->reward }}飞吻</span>
                            <span class="layui-btn layui-btn-xs jie-admin" type="edit"><a href="add.html">编辑此贴</a></span>
                        </div>
                    </div>
                    <div class="detail-body photos">
                      {!! $post->content !!}
                    </div>
                </div>

                <div class="fly-panel detail-box" id="flyReply">
                    <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                        <legend>回帖</legend>
                    </fieldset>

                    <ul class="jieda" id="jieda">
                        @foreach($post->comments as $comment)
                        <li data-id="111">
                            <a name="item-1111111111"></a>
                            <div class="detail-about detail-about-reply">
                                <a class="fly-avatar" href="">
                                    <img src="{{ $comment->user->avatar }}" alt=" ">
                                </a>
                                <div class="fly-detail-user">
                                    <a href="#" class="fly-link">
                                        <cite>{{ $comment->user->name }}</cite>
                                    </a>
                                </div>
                                <div class="detail-hits">
                                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="detail-body jieda-body photos">
                                <p>{!! $comment->content !!}</p>
                            </div>
                            <div class="jieda-reply">
                                <span class="jieda-zan" type="zan">
                                    <i class="iconfont icon-zan"></i>
                                    <em>0</em>
                                </span>
                                <span type="reply">
                                    <i class="iconfont icon-svgmoban53"></i>
                                    回复
                                </span>
                                <div class="jieda-admin">
                                    <span type="edit">编辑</span>
                                    <span type="del">删除</span>
                                    <span class="jieda-accept" type="accept">采纳</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        <!-- 无数据时 -->
                        <!-- <li class="fly-none">消灭零回复</li> -->
                    </ul>

                    <div class="layui-form layui-form-pane">
                        <form id="replyForm">
                            <div class="layui-form-item layui-form-text">
                                <a name="comment"></a>
                                <div id="my-editormd" >
                                    <textarea id="my-editormd-markdown-doc" style="display:none;"></textarea>
                                    <!-- 注意：name属性的值-->
                                    <textarea id="my-editormd-html-code" style="display:none;"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <input type="hidden" name="jid" value="123">
                                <button class="layui-btn" lay-filter="reply" lay-submit>提交回复</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @include('layouts.right')

        </div>
    </div>
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
                fd.append('user_id',{{ $post->user->id }});
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
    </script>
@endsection