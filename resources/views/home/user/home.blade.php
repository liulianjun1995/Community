@extends('layouts.main')
@section('container')
<div class="fly-home fly-panel" style="background-image: url();">
  <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
  <h1>
    {{ $user->name }}
    <i class="iconfont @if($user->sex == '男') icon-nan @else icon-nv @endif"></i>
    <!-- <i class="iconfont icon-nv"></i>  -->
    {{--<i class="layui-badge fly-badge-vip">VIP3</i>--}}
    <!--
    <span style="color:#c00;">（管理员）</span>
    <span style="color:#5FB878;">（社区之光）</span>
    <span>（该号已被封）</span>
    -->
  </h1>

  {{--<p style="padding: 10px 0; color: #5FB878;">认证信息：layui 作者</p>--}}

  <p class="fly-home-info">
    <i class="iconfont icon-kiss" title="飞吻"></i><span style="color: #FF7200;">{{ $user->reward }} 飞吻</span>
    <i class="iconfont icon-shijian"></i><span>{{ $user->created_at->toDateString() }} 加入</span>
    <i class="iconfont icon-chengshi"></i><span>来自{{ $user->city }}</span>
  </p>

  <p class="fly-home-sign">（{!! $user->sign !!}）</p>

</div>

<div class="layui-container">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md6 fly-home-jie">
      <div class="fly-panel">
        <h3 class="fly-panel-title">{{ $user->name }} 最近的提问</h3>
        <ul class="jie-row">
          @if($user->posts()->count())
          @foreach($user->posts as $post)
          <li>
            @if($post->is_top == 1)
            <span class="layui-badge layui-bg-orange">置顶</span>
            @endif
            @if($post->is_sticky == 1)
              <span class="layui-badge layui-bg-red">精</span>
            @endif
            <span class="layui-badge" style="{{ $post->category->tip_style }}">{{ $post->category->name }}</span>
            <a href="" class="jie-title"> {{ $post->title }}</a>
            <i>{{ $post->created_at->diffForHumans() }}</i>
            <em class="layui-hide-xs">{{ $post->renqi }}阅/{{ $post->comments->count() }}答</em>
          </li>
          @endforeach
          @else
          <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div>
          @endif
        </ul>
      </div>
    </div>

    <div class="layui-col-md6 fly-home-da">
      <div class="fly-panel">
        <h3 class="fly-panel-title">{{ $user->name }} 最近的回答</h3>
        <ul class="home-jieda">
          @if($user->comments->count())
          @foreach($user->comments as $comment)
          <li>
            <p>
            <span>{{ $comment->created_at->diffForHumans() }}</span>
            在<a href="/post/{{$comment->post->id}}" target="_blank">{{ $comment->post->title }}</a>中回答：
            </p>
            <div class="home-dacontent">
              {!! $comment->content !!}
            </div>
          </li>
          @endforeach
          @else
          <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>没有回答任何问题</span></div>
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection