<style>
    .emoji{
        width: 20px;
        height: 20px;
    }
</style>
<ul class="jieda" id="jieda">
    @if($post->comments->count()>0)
        @foreach($post->comments as $comment)
            <li data-id="111">
                <a name="item-1111111111"></a>
                <div class="detail-about detail-about-reply">
                    <a class="fly-avatar" href="/user/{{ $comment->user->id }}/home">
                        <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}">
                    </a>
                    <div class="fly-detail-user">
                        <a href="/user/{{ $comment->user->id }}/home" class="fly-link">
                            <cite>{{ $comment->user->name }}</cite>
                        </a>
                    </div>
                    <div class="detail-hits">
                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="detail-body jieda-body photos">
                    {!! $comment->content !!}
                </div>
                <div class="jieda-reply">
                    @if($comment->zan(Auth::id())->exists())
                    <span class="jieda-zan zanok" type="zan" onclick="unzan(this,{{ $comment->id }})">
                            @else
                            @login
                            <span class="jieda-zan" type="zan" onclick="dozan(this,{{ $comment->id }})">
                            @else
                            <span class="jieda-zan" type="zan" onclick="layer.msg('请先登录')">
                            @endlogin
                            @endif
                            <i class="iconfont icon-zan"></i>
                            <span>{{ $comment->zans->count() }}</span>
                    </span>
                    <div class="jieda-admin">
                        <span type="edit">编辑</span>
                        @if(Auth::id() == $comment->user->id)
                            <span type="del" onclick="delComment(this,{{ $comment->id }},{{ $comment->user->id }})">删除</span>
                        @endif
                        @if(Auth::id() == $post->user->id)
                        <span class="jieda-accept" type="accept">采纳</span>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    @else
    <!-- 无数据时 -->
        <li class="fly-none">消灭零回复</li>
    @endif
</ul>

<script>
    function delComment(obj,comment_id,user_id) {
        $.ajax({
            url:"/user/delComment",
            type:'post',
            data:{'user_id':user_id,'comment_id':comment_id},
            dataType:'json',
            success:function (res) {
                if (res.error == 0){
                    layer.msg(res.msg);
                    var target = $(obj);
                    target.parent().parent().parent().remove();

                }else if (res.error == 1){
                    layer.msg(res.msg);
                }
            }
        });
    }
</script>