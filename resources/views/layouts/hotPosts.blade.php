<dl class="fly-panel fly-list-one" id="hotPosts">

</dl>

<script>

    $.ajax({
        url:'/hotPosts',
        type:'get',
        dataType:'json',
        success:function (res) {
            var s =  '<dt class="fly-panel-title">热门帖子</dt>';
            if(res.length>0){
                for (var i = 0 ; i<res.length; i++){
                    s += "<dd>";
                    s += "<a href=\"/post/"+res[i].id+"\">"+res[i].title+"</a>&nbsp;";
                    s += "<span><i class=\"iconfont icon-pinglun1\"></i>&nbsp;"+ res[i].comments_count +"</span>";
                    s += "</dd>";
                }
            }else{
                s += "<div class=\"fly-none\">没有相关数据</div>";
            }
            $("#hotPosts").html(s);
        }
    });
</script>