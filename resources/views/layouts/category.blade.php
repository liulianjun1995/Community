<style>
    .container{
        width: 1200px;
        height: 132px;
        margin: 0 auto;
        padding: 0 10px;
    }
    .xm3{
        width: 25%;
        float: left;
    }
    .category dl {
        position: relative;
        margin: 10px;
        padding: 15px;
        background: #f5f5f5;
        border-radius: 8px;
        height: 55px;
        overflow: hidden;
    }
    .category dl dt{
        width: 60px;
        height: 60px;
        float: left;
    }
    .category dl dd{
        padding-left: 70px;
        line-height: 20px;
    }
    .category>dl{
        border: 1px solid #e2e2e2;
    }
    .category dl dd span {
        color: #999;
        font-size: 12px;
    }

    .category>dl:hover{
        background-color: #e2e2e2;
    }
</style>
{{-- 板块 --}}
<div class="container" style="width:100%;height:100px;">
    <div class="container" id="categorys">

    </div>
</div>
<script>
    //获取版块
    $.ajax({
        url:'/getCategory',
        method:'get',
        success:function (res) {
            var s = "";
            for(var i = 0;i<res.length;i++){
                s += "<div class=\"x112 xs6 xm3\"><div class=\"category\"><dl><dt>";
                s += "<a href=\"/category/"+res[i].id+"\">";
                s += "<img src=\""+ res[i].img +"\" width=\"60px\" height=\"60px\" alt=\""+ res[i].name +"\"></a></dt>";
                s += "<dd><p><a class=\"title\" href=\"#\" style=\""+res[i].style+"\">"+res[i].name+"</a></p>";
                s += "<span>"+res[i].describe+"</span></dd>";
                s += "</dl></div></div>";
            }
            document.getElementById('categorys').innerHTML=s;
        }
    })
</script>