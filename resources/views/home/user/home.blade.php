@extends('layouts.main')
@section('container')
<div class="fly-home fly-panel">
    @if(\App\Model\UserUseGoods::where('user_id',$user->id)->where('type_id','6')->get()->count())
        <img src="{{ \App\Model\Goods::where('id',\App\Model\UserUseGoods::where('type_id','6')->first()['goods_id'])->first()['img'] }}" style="display: inline-block;position:absolute;margin-top: -35px" draggable="false">
    @endif
  <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
  <h1>
    {{ $user->name }}@if($user->isAdmin)<span style="color:#c00;font-size: 26px;">（管理员）</span>@endif
    <i class="iconfont @if($user->sex == '男') icon-nan @else icon-nv @endif"></i>
  </h1>

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
        <ul class="jie-row" id="posts">
          @if(!$user->posts()->count())
          <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div>
          @endif
        </ul>
      </div>
    </div>

    <div class="layui-col-md6 fly-home-da">
      <div class="fly-panel">
        <h3 class="fly-panel-title">{{ $user->name }} 最近的回答</h3>
        <ul class="home-jieda" @if($user->comments->count()) id="comments" @endif>
          @if($user->comments->count())
          @else
          <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>没有回答任何问题</span></div>
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
    layui.use('flow', function(){
        var flow = layui.flow;

        flow.load({
            elem: '#comments' //流加载容器
            ,done: function(page, next) { //执行下一页的回调
                var lis = [];
                $.get("/user/{{ $user->id }}/getComments?page="+page, function(res){
                    //假设你的列表返回在data集合中
                    layui.each(res.data, function(index, item){
                        lis.push('<li><p><span>'+ item.created_at+"</span>"
                                +'在'+"<a href=\"/post/"+item.post_id+"\" target=\"_blank\">"+item.post.title+"</a>中回答："
                                +"</p>"
                                +"<div class=\"home-dacontent\">"
                                +item.content
                                +"</div>"
                                +'</li>');

                    });
                    //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                    //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                    next(lis.join(''), page < res.total);
                });
            }
        });
        flow.load({
            elem: '#posts' //流加载容器
            ,done: function(page, next) { //执行下一页的回调
                var lis = [];
                $.get("/user/{{ $user->id }}/getPosts?page="+page, function(res){
                    //假设你的列表返回在data集合中
                    layui.each(res.data, function(index, item){
                        var html = "<li>";
                        if (item.is_top == 1){
                            html += "<span class=\"layui-badge layui-bg-orange\">置顶</span>";
                        }
                        if (item.is_sticky == 1){
                            html +="<span class=\"layui-badge layui-bg-red\">精</span>";
                        }
                        html += "<span class=\"layui-badge\" style=\"+"+item.category.tip_style+"\">"+item.category.name+"</span>";
                        html += "<a href=\"/post/"+item.id+"\" class=\"jie-title\">"+item.title+"</a>";
                        html += "<em class=\"layui-hide-xs\"><i class=\"iconfont icon-pinglun1\" style='font-size: 15px' title=\"回答\"></i> "+item.comments_count+"</em>";
                        html += "</li>";
                        lis.push(html);
                    });
                    //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                    //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                    next(lis.join(''), page < res.total);
                });
            }
        });
    });
</script>
@endsection