@extends('layouts.main')
@section('container')
<div class="layui-container fly-marginTop fly-user-main">
    @include('home.user.main')
    <div class="fly-panel fly-panel-user">
        <div class="layui-tab layui-tab-brief"id="LAY_msg" style="margin-top: 15px;">
            <div  id="LAY_minemsg" style="margin-top: 10px;padding: 10px 20px">
                <!--<div class="fly-none">您暂时没有最新消息</div>-->
                <ul class="mine-msg">
                    @foreach(Auth::user()->newComments as $comment)
                    <li data-id="123">
                        <blockquote class="layui-elem-quote">
                            <a href="/user/{{ $comment->post->user->id }}/home" target="_blank"><cite>{{ $comment->post->user->name }}</cite></a>回答了您的求解<a target="_blank" href="/post/{{ $comment->post->id }}"><cite>{{ $comment->post->title }}</cite></a>
                        </blockquote>
                        <p><span>{{ $comment->created_at->diffForHumans() }}</span></p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection