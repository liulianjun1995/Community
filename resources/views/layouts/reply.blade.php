<div class="fly-panel fly-rank fly-rank-active" id="activeRank">

</div>

<script>
    $.ajax({
        url:'/getActiveRank',
        type:'get',
        dataType:'json',
        success:function (res) {
            var s =  '<h3 class="fly-panel-title right-title" style=\'border-bottom: 1px solid #01aaed;\'>回贴榜</h3><dl>';
            if(res.length>0){
                for (var i = 0 ; i<res.length; i++){
                    s += "<dd>";
                    s += "<a href=\"/user/"+res[i].id+"/home\" target='_blank'>";
                    s += "<img src=\""+res[i].avatar+"\" style='border-radius: 45px'><cite style='border-radius: 45px'>"+res[i].name+"</cite><i>"+res[i].comments_count+"次回答</i></a>";
                    s += "</dd>";
                }
                s += "</dl>";
            }else{
                s += "<div class=\"fly-none\">没有相关数据</div>";
            }
            $("#activeRank").html(s);
        }
    });
</script>