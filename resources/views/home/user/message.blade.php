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
                <div class="layui-tab-item layui-show">
                <ul class="mine-msg">
                    @foreach(Auth::user()->newComments as $comment)
                    <li>
                        <blockquote class="layui-elem-quote">
                            <a href="/user/{{ $comment->post->user->id }}/home" target="_blank"><cite>{{ $comment->post->user->name }}</cite></a>回答了您的求解<a target="_blank" href="/post/{{ $comment->post->id }}"><cite>{{ $comment->post->title }}</cite></a>
                        </blockquote>
                        <p><span>{{ $comment->created_at->diffForHumans() }}</span></p>
                    </li>
                    @endforeach
                </ul>
                </div>
                <div class="layui-tab-item layui-show">
                    <div id="LAY_minemsg">
                        <div class="fly-none">您暂时没有最新消息</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection