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
                <div class="detail-about detail-about-reply" comment="{{ $comment->id }}">
                    <a class="fly-avatar" href="/user/{{ $comment->user->id }}/home">
                        @if(\App\Model\UserUseGoods::where('user_id',$comment->user->id)->where('type_id','6')->get()->count())
                            <img src="{{ \App\Model\Goods::where('id',\App\Model\UserUseGoods::where('type_id','6')->first()['goods_id'])->first()['img'] }}" style="display: inline-block;position:absolute;margin-top: -10px" draggable="false">
                        @endif
                        <img src="{{ $comment->user->avatar }}" style="border-radius: 45px" alt="{{ $comment->user->name }}">
                    </a>
                    <div class="fly-detail-user">
                        <a href="/user/{{ $comment->user->id }}/home" class="fly-link">
                            <cite>{{ $comment->user->name }}</cite>
                        </a>
                    </div>
                    <div class="detail-hits">
                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    @if($comment->is_accept)
                    <i class="iconfont icon-caina" title="最佳答案"></i>
                    @endif
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
                        @if(Auth::id() == $comment->user->id)
                            <span type="del" onclick="delComment(this,{{ $comment->id }},{{ $comment->user->id }})">删除</span>
                        @endif
                        @if((Auth::id() == $post->user->id) && (Auth::id() != $comment->user->id) && !$post->is_closed)
                        <span class="jieda-accept" type="accept" onclick="accept({{ $post->id }},{{ $comment->id }},{{ $post->user->id }})">采纳</span>
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
<div class="layui-form layui-form-pane">
    <form id="replyForm">
        <div class="layui-form-item layui-form-text">
            <a name="comment"></a>
            <!-- 富文本编辑器-->
            <div id="my-editormd" >
                <textarea id="my-editormd-markdown-doc" style="display:none;"></textarea>
                <!-- 注意：name属性的值-->
                <textarea id="my-editormd-html-code" style="display:none;"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            @login
                @can('speak')
                    <button class="layui-btn" type="button"  onclick="layer.msg('您已被禁言')">提交回复</button>
                @elsecan('defriend')
                    <button class="layui-btn" type="button"  onclick="layer.msg('您已被拉黑')">提交回复</button>
                @else
                <button class="layui-btn" lay-filter="reply" lay-submit>提交回复</button>                @endcan
            @else
                <button class="layui-btn" type="button"  onclick="layer.msg('请先登录')">提交回复</button>
            @endlogin
        </div>
    </form>
</div>

<script>
    //删除评论
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
    //点赞
    function dozan(obj,id) {
        var target = $(obj);
        //alert(id);
        $.ajax({
            url:'/user/'+id+'/zan',
            type:'get',
            dataType:'json',
            success:function (res) {
                if(res.error==1){
                    target.addClass('zanok');
                    var zanNum = target.children('span').text();
                    target.children('span').text(parseInt(zanNum)+1);
                    target.attr("onclick","unzan(this,"+id+")");
                }else{
                    layer.msg(res.msg);
                }
            }
        });


    }
    //取消赞
    function unzan(obj,id) {
        var target = $(obj);
        $.ajax({
            url:'/user/'+id+'/unzan',
            type:'get',
            dataType:'json',
            success:function (res) {
                if(res.error==1){
                    target.removeClass('zanok');
                    var zanNum = target.children('span').text();
                    target.children('span').text(parseInt(zanNum)-1);
                    target.attr("onclick","dozan(this,"+id+")");
                }else{
                    layer.msg(res.msg);
                }
            }
        });

    }
    //采纳评论
    function accept(post_id,comment_id,post_user_id) {
        $.ajax({
            url:'/user/acceptComment',
            type:'post',
            data:{'post_id':post_id,'comment_id':comment_id,'post_user_id':post_user_id},
            dataType:'json',
            success:function (res) {
                if (res.error == 0){
                    $("div[comment='"+comment_id+"']").append("<i class=\"iconfont icon-caina\" title=\"最佳答案\"></i>");
                    $("span[type='accept']").remove();
                } else{
                    layer.msg(res.msg);
                }
            },
            error:function () {
                layer.msg('请求失败，请稍候重试');
            }
        });
    }
</script>