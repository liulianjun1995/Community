<dl class="fly-panel fly-list-one" id="recommendations">

</dl>

<script>

    $.ajax({
        url:'/recommendations',
        type:'get',
        dataType:'json',
        success:function (res) {
            var s =  '<dt class="fly-panel-title right-title" style=\'border-bottom: 1px solid #01aaed\'>推荐</dt>';
            if(res.length>0){
                for (var i = 0 ; i<res.length; i++){
                    if(i==0){
                        s += "<dd style='line-height: 23px'><span class=\"layui-badge layui-bg-red\">"+(i+1)+"</span>&nbsp;";
                    }else if (i==1){
                        s += "<dd><span class=\"layui-badge layui-bg-green\">"+(i+1)+"</span>&nbsp;";
                    }else if (i==2){
                        s += "<dd><span class=\"layui-badge layui-bg-blue\">"+(i+1)+"</span>&nbsp;";
                    }else {
                        s += "<dd><span class=\"layui-badge layui-bg-gray\">"+(i+1)+"</span>&nbsp;";
                    }
                    s += "<a href=\"/post/"+res[i].id+"\">"+res[i].title+"</a>&nbsp;";
                    s += "<span><i class=\"iconfont icon-pinglun1\" title='回答'></i>&nbsp;"+ res[i].comments_count +"</span>";
                    s += "</dd>";
                }
            }else{
                s += "<div class=\"fly-none\">没有相关数据</div>";
            }
            $("#recommendations").html(s);
        }
    });
</script>