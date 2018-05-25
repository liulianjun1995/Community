@extends('layouts.main')

@section('container')
    <style>
        .post-list{
            padding:0 10px;
        }
        .laytable-cell-1-title {
            width: 343px;
        }
        .layui-table-cell {
            height: 28px;
            line-height: 28px;
            padding: 0 15px;
            position: relative;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-sizing: border-box;
        }
        .laytable-cell-1-status {
            width: 100px;
        }
        .laytable-cell-1-status {
            width: 100px;
        }
        .layui-table-cell {
            height: 28px;
            line-height: 28px;
            padding: 0 15px;
            position: relative;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-sizing: border-box;
        }
        .laytable-cell-1-time {
            width: 120px;
        }

        .layui-table-cell {
            height: 28px;
            line-height: 28px;
            padding: 0 15px;
            position: relative;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-sizing: border-box;
        }
        .laytable-cell-1-4 {
            width: 150px;
        }

        .layui-table-cell {
            height: 28px;
            line-height: 28px;
            padding: 0 15px;
            position: relative;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-sizing: border-box;
        }
        .laytable-cell-1-5 {
            width: 120px;
        }
        .layui-table-cell {
            height: 28px;
            line-height: 28px;
            padding: 0 15px;
            position: relative;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-sizing: border-box;
        }
    </style>
    <div class="layui-container fly-marginTop fly-user-main">
        @include('home.user.main')
        <div class="fly-panel fly-panel-user">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title" id="LAY_mine" style="margin: 0px 10px;padding-top: 10px">
                    <li data-type="mine-jie" @if(strpos($_SERVER['REQUEST_URI'],'collection')==false) class="layui-this" @endif >我发的帖（<span>{{ Auth::user()->posts->count() }}</span>）</li>
                    <li data-type="collection" @if(strpos($_SERVER['REQUEST_URI'],'collection')!==false) class="layui-this" @endif>我收藏的帖（<span>{{ Auth::user()->save_posts->count() }}</span>）</li>
                </ul>
                <div class="layui-tab-content">
                    {{-- 发表的帖子 --}}
                    <div class="layui-tab-item @if(strpos($_SERVER['REQUEST_URI'],'collection')==false) layui-show @endif">
                        <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-1" style=" ">
                            <div class="layui-table-box">
                                <div class="layui-table-header">
                                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line">
                                        <thead><tr><th data-field="title" data-minwidth="300"><div class="layui-table-cell laytable-cell-1-title"><span>帖子标题</span></div></th><th data-field="status"><div class="layui-table-cell laytable-cell-1-status" align="center"><span>状态</span></div></th><th data-field="status"><div class="layui-table-cell laytable-cell-1-status" align="center"><span>结贴</span></div></th><th data-field="time"><div class="layui-table-cell laytable-cell-1-time" align="center"><span>发表时间</span></div></th><th data-field="4"><div class="layui-table-cell laytable-cell-1-4"><span>数据</span></div></th><th data-field="5"><div class="layui-table-cell laytable-cell-1-5"><span>操作</span></div></th></tr></thead>
                                    </table>
                                </div>
                                <div class="layui-table-body layui-table-main">
                                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line">
                                        <tbody>
                                        @foreach($posts as $post)
                                        <tr data-index="0" class="">
                                            <td data-field="title" data-content="{{ $post->title }}" data-minwidth="300">
                                                <div class="layui-table-cell laytable-cell-1-title">
                                                    <a href="/post/{{ $post->id }}" target="_blank" class="layui-table-link">{{ $post->title }}</a>
                                                </div>
                                            </td>
                                            <td data-field="status" align="center" data-content="0">
                                                <div class="layui-table-cell laytable-cell-1-status">
                                                    <span style="color: #999;">正常</span>
                                                </div>
                                            </td>
                                            <td data-field="status" align="center" data-content="0">
                                                <div class="layui-table-cell laytable-cell-1-status">
                                                    <span style="color: #ccc;">{{ $post->is_closed?'已结':'未结' }}</span>
                                                </div>
                                            </td>
                                            <td data-field="time" align="center" data-content="1519825273601">
                                                <div class="layui-table-cell laytable-cell-1-time">{{ $post->created_at->diffForHumans() }} </div>
                                            </td>
                                            <td data-field="4" data-content="">
                                                <div class="layui-table-cell laytable-cell-1-4">
                                                    <span style="font-size: 12px;">{{ $post->visitors->sum('clicks') }}阅/{{ $post->comments->count() }}答</span>
                                                </div>
                                            </td>
                                            <td data-field="5" data-content="">
                                                <div class="layui-table-cell laytable-cell-1-5">
                                                    <a class="layui-btn layui-btn-xs" href="/user/post/{{ $post->id }}/edit" target="_blank">编辑</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $posts->render() }}
                    </div>

                    {{-- 收藏的帖子 --}}
                    <div class="layui-tab-item @if(strpos($_SERVER['REQUEST_URI'],'collection')!==false) layui-show @endif">
                            <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-3" style=" ">
                                <div class="layui-table-box">
                                    <div class="layui-table-header">
                                        <table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line">
                                            <thead>
                                            <tr>
                                                <th data-field="title" data-minwidth="300">
                                                    <div class="layui-table-cell laytable-cell-3-title">
                                                        <span>帖子标题</span>
                                                    </div>
                                                </th>
                                                <th data-field="collection_timestamp">
                                                    <div class="layui-table-cell laytable-cell-3-collection_timestamp" align="center">
                                                        <span>收藏时间</span>
                                                    </div>
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>

                                    <div class="layui-table-body layui-table-main">
                                        <table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line">
                                            <tbody>
                                                @if(count($savePosts))
                                                @foreach($savePosts as $savePost)
                                                <tr data-index="0" class="">
                                                    <td data-field="title" data-content="" data-minwidth="300">
                                                        <div class="layui-table-cell laytable-cell-3-title">
                                                            <a href="/post/{{ $savePost->post_id }}" target="_blank" class="layui-table-link">{{ \App\Model\Post::where('id',$savePost->post_id)->first()['title'] }}</a>
                                                        </div>
                                                    </td>
                                                    <td data-field="collection_timestamp" align="center">
                                                        <div class="layui-table-cell laytable-cell-3-collection_timestamp">
                                                            {{ $savePost->created_at->diffForHumans() }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        @if(!count($savePosts))
                                        <div class="layui-none">无数据</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="layui-table-page layui-hide"><div id="layui-table-page3"></div></div><style>.laytable-cell-3-title{ width: 793px; }.laytable-cell-3-collection_timestamp{ width: 120px; }</style>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection