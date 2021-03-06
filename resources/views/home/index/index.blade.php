@extends('layouts.main')

@section('container')
    @include('layouts.panel')
    <style>
        .msg{
            margin: 0 auto;
            margin-bottom: 6px;
            font-size: 20px;
        }
        .msg a{
            font-size: 25px;
        }
    </style>
    <div class="layui-container content">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8" >
                {{-- 置顶 --}}
                <div class="fly-panel" id="top" style="border: 1px solid #eee">
                    <div class="fly-panel-title fly-filter">
                        <a>置顶</a>
                    </div>
                    <ul class="fly-list">
                        @foreach(session()->get('tops') as $top)
                        <li>
                            <td style="position: relative">
                            <a href="/user/{{ $top->user->id }}/home" class="fly-avatar">
                                {{-- 头饰 --}}
                                @if(\App\Model\UserUseGoods::where('user_id',$top->user->id)->where('type_id','6')->get()->count())
                                <img src="{{ \App\Model\Goods::where('id',\App\Model\UserUseGoods::where('type_id','6')->first()['goods_id'])->first()['img'] }}" style="display: inline-block;position:absolute;margin-top: -10px" draggable="false">
                                @endif

                                <img src="{{ $top->user->avatar }}" draggable="false" width="50px" height="50px" style="display: inline-block;margin-top: 5px;border-radius: 45px" alt="/{{ $top->user->name }}">
                            </a>
                            </td>
                            <h2>
                                <span class="layui-badge layui-bg-orange" style="top: -8px;border: none;">置顶</span>
                                <span class="layui-badge" style="{{ $top->category->tip_style }};top: -8px;border: none;">{{ $top->category->name }}</span>
                                <a href="/post/{{ $top->id }}" target='_blank'>{{ $top->title }}</a>
                            </h2>
                            <div class="fly-list-info">
                                <a href="/user/{{ $top->user->id }}/home" >
                                    <cite>{{ $top->user->name }}@admin <span style="color:#c00;">（管理员）</span>@endadmin</cite>
                                </a>
                                <span>{{ $top->created_at->diffForHumans() }}</span>

                                <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻">
                                    <i class="iconfont icon-kiss"></i> {{ $top->reward }}
                                </span>
                                @if($top->is_closed)
                                <span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>
                                @endif
                                <span class="fly-list-nums">
                                    <i class="iconfont icon-pinglun1" title="回答"></i> {{ $top->comments->count() }}
                                    <i class="iconfont" title="浏览"></i> {{ $top->visitors->sum(['clicks']) }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                {{-- 帖子 --}}
                @if(isset($msg))
                    <div class="msg">
                        {!! $msg !!}
                    </div>
                @endif
                <div class="fly-panel" style="border: 1px solid #eee">
                    <ul class="fly-list">
                        @if($posts->count())
                        @foreach($posts as $post)
                        <li>
                            <td style="position:relative;">
                            <a href="/user/{{ $post->user->id }}/home" class="fly-avatar">
                                {{-- 头饰 --}}
                                @if(\App\Model\UserUseGoods::where('user_id',$top->user->id)->where('type_id','6')->get()->count())
                                    <img src="{{ \App\Model\Goods::where('id',\App\Model\UserUseGoods::where('type_id','6')->first()['goods_id'])->first()['img'] }}" style="display: inline-block;position:absolute;margin-top: -10px" draggable="false">
                                @endif
                                <img src="{{ $post->user->avatar }}" style="margin-top: 5px;border-radius: 45px" alt="{{ $post->user->name }}">
                            </a>
                            </td>
                            <h2>
                                <a class="layui-badge" style="{{ $post->category->tip_style }};border: none;top: -3px;">{{ $post->category->name }}</a>
                                <a href="/post/{{ $post->id }}" target='_blank'>{{ $post->title }}</a>
                            </h2>
                            <div class="fly-list-info">
                                <a href="/user/{{ $post->id }}/home" link>
                                    <cite>{{ $post->user->name }}@admin <span style="color:#c00;">（管理员）</span>@endadmin</cite>
                                </a>
                                <span>{{ $post->created_at->diffForHumans() }}</span>

                                <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> {{ $post->reward }}</span>
                                @if($post->is_closed)
                                    <span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>
                                @endif
                                <span class="fly-list-nums">
                                <i class="iconfont icon-pinglun1" title="回答"></i> {{ $post->comments->count() }}
                                <i class="iconfont" title="浏览"></i> {{ $post->visitors->sum(['clicks']) }}
                            </span>
                            </div>
                            <div class="fly-list-badge">
                                @if($post->is_sticky)
                                <span class="layui-badge layui-bg-red">精帖</span>
                                @endif
                            </div>
                        </li>
                        @endforeach
                        @else
                        <li style="text-align: center;">
                            <div class="fly-list-info" style="line-height: 50px">
                                <span style="font-size: 25px"><b>没有找到相关内容</b></span>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
                {{ $posts->links() }}
            </div>

            <div class="layui-col-md4">
                {{-- 官方公告 --}}
                @include('layouts.Announcement')
                {{-- 签到 --}}
                @include('layouts.signin')
                {{-- 回贴周榜 --}}
                @include('layouts.reply')
                @include('layouts.right')
            </div>
        </div>
    </div>
@endsection