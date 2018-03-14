<div class="fly-panel" id="getGonggao">

</div>

<script>
    $.ajax({
        url:'/getGonggao',
        type:'get',
        dataType:'json',
        success:function (res) {
            var s = "<h3 class=\"fly-panel-title\">官方公告</h3>";
            s += "<ul class=\"fly-panel-main fly-list-static\">";
            if(res.length>0){
                for(var i = 0;i < res.length;i++){
                    s += "<li style=\"list-style: none\">";
                    s += "<span class=\"layui-badge layui-bg-orange\">"+(i+1)+"</span>";
                    s += "<a href=\"/post/"+res[i].id+"\" target=\"_blank\">&nbsp;"+res[i].title+"</a>";
                    s += "</li>";
                }
                s += "</ul>";
            }
            $("#getGonggao").html(s);
        }
    });
</script>