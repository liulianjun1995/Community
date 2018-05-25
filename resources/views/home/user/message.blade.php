@extends('layouts.main')
@section('container')
<div class="layui-container fly-marginTop fly-user-main">
    @include('home.user.main')
    <div class="layui-container fly-marginTop fly-user-main">
        @include('home.user.main')
    <div class="fly-panel fly-panel-user">
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title" id="LAY_mine">
                <li class="layui-this">回复我的</li>
                <li>系统消息</li>
            </ul>
            <div class="layui-tab-content">
                @if(count($messages))
                <div class="layui-tab-item layui-show">
                    <ul class="mine-msg">
                        @foreach($messages as $message)
                            @if($message->type == 'comment')
                        <li>
                            <blockquote class="layui-elem-quote">
                                <a href="/user/{{ $message->from_user_id }}/home" target="_blank"><cite>{{ $message->from_user->name }}</cite></a>回答了您的求解<a target="_blank" href="/post/{{ $message->from_post->id }}"><cite>{{ $message->from_post->title }}</cite></a>
                            </blockquote>
                            <p><span>{{ $message->created_at->diffForhumans() }}</span></p>
                        </li>
                            @endif
                        @endforeach
                    </ul>
                    @else
                    <div id="LAY_minemsg">
                        <div class="fly-none">您暂时没有最新消息</div>
                    </div>
                    @endif
                </div>
                {{-- 系统通知 --}}
                <div class="layui-tab-item layui-show">
                    <div id="LAY_minemsg">
                        <div class="fly-none">您暂时没有最新消息</div>
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

        $.ajax({
            url:'/user/readMessage',
            type:'post',
            dataType:'json',
            success:function (res) {
                console.log(res.msg);
            },
            error:function () {
                console.log('请求失败');
            }
        });
    </script>
@endsection

