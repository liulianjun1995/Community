<div class="fly-panel" id="getGonggao">

</div>

<script>
    $.ajax({
        url:'/getGonggao',
        type:'get',
        dataType:'json',
        success:function (res) {
            var s = "<h3 class=\"fly-panel-title right-title\" style='border-bottom: 1px solid #01aaed'>官方公告</h3>";
            s += "<ul class=\"fly-panel-main fly-list-static\">";
            if(res.length>0){
                for(var i = 0;i < res.length;i++){
                    s += "<li style=\"list-style: none\">";
                    if(i==0){
                        s += "<dd style='line-height: 23px'><span class=\"layui-badge layui-bg-red\">"+(i+1)+"</span>&nbsp;";
                    }else if (i==1){
                        s += "<dd><span class=\"layui-badge layui-bg-green\">"+(i+1)+"</span>&nbsp;";
                    }else if (i==2){
                        s += "<dd><span class=\"layui-badge layui-bg-blue\">"+(i+1)+"</span>&nbsp;";
                    }else {
                        s += "<dd><span class=\"layui-badge layui-bg-gray\">"+(i+1)+"</span>&nbsp;";
                    }
                    s += "<a href=\"/post/"+res[i].id+"\" target=\"_blank\">&nbsp;"+res[i].title+"</a>";
                    s += "</li>";
                }
                s += "</ul>";
            }
            $("#getGonggao").html(s);
        }
    });
</script>