@extends('layouts.main')

@section('container')
  <style>
    .post-list{
      padding:0 10px;
    }
  </style>
  <div class="layui-container fly-marginTop fly-user-main">
    @include('home.user.main')

    <div class="fly-panel fly-panel-user">
      <!--
      <div class="fly-msg" style="margin-top: 15px;">
        您的邮箱尚未验证，这比较影响您的帐号安全，<a href="activate.html">立即去激活？</a>
      </div>
      -->
      <div class="layui-tab layui-tab-brief" lay-filter="user">
        <ul class="layui-tab-title" id="LAY_mine">
          <li data-type="mine-jie" lay-id="index" @if(strpos($_SERVER['REQUEST_URI'],'collection')==false) class="layui-this" @endif >我发的帖（<span>{{ Auth::user()->posts->count() }}</span>）</li>
          <li data-type="collection" data-url="/collection/find/" lay-id="collection" @if(strpos($_SERVER['REQUEST_URI'],'collection')!==false) class="layui-this" @endif>我收藏的帖（<span>16</span>）</li>
        </ul>
        <div class="layui-tab-content" style="padding: 20px 0;">
          {{-- 发表的帖子 --}}
          <div class="layui-tab-item @if(strpos($_SERVER['REQUEST_URI'],'collection')==false) layui-show @endif">
            <ul class="mine-view jie-row">
              @foreach($posts as $post)
              <li class="post-list">
                <a class="jie-title" style="" href="/post/{{ $post->id }}" target="_blank">{{ $post->title }}</a>
                <i>{{ $post->created_at->diffForHumans() }}</i>
                <a class="mine-edit" href="#">编辑</a>
                <em>{{ $post->renqi }}阅/{{ $post->comments->count() }}答</em>
              </li>
              @endforeach
            </ul>
            <div id="LAY_page"></div>
          </div>
          {{-- 收藏的帖子 --}}
          <div class="layui-tab-item @if(strpos($_SERVER['REQUEST_URI'],'collection')!==false) layui-show @endif">
            <ul class="mine-view jie-row">
              <li>
                <a class="jie-title" href="../jie/detail.html" target="_blank">基于 layui 的极简社区页面模版</a>
                <i>收藏于23小时前</i>  </li>
            </ul>
            <div id="LAY_page1"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection