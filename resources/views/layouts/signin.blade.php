<div class="fly-panel fly-signin">
    <div class="fly-panel-title">
        签到
        <i class="fly-mid"></i>
        <a href="javascript:;" class="fly-link" id="LAY_signinHelp">说明</a>
        <i class="fly-mid"></i>
        <a href="javascript:;" class="fly-link" id="LAY_signinTop">活跃榜<span class="layui-badge-dot"></span></a>
        <span class="fly-signin-days">已连续签到<cite>16</cite>天</span>
    </div>
    <div class="fly-panel-main fly-signin-main">
        <button class="layui-btn layui-btn-danger" id="LAY_signin">今日签到</button>
        <span>可获得<cite>5</cite>飞吻</span>

        <!-- 已签到状态 -->
        <!--
        <button class="layui-btn layui-btn-disabled">今日已签到</button>
        <span>获得了<cite>20</cite>飞吻</span>
        -->
    </div>
</div>

<script>
    //签到说明
    var elemSigninHelp = $('#LAY_signinHelp')
    elemSigninHelp.on('click', function(){
        layer.open({
            type: 1
            ,title: '签到说明'
            ,area: '300px'
            ,shade: 0.8
            ,shadeClose: true
            ,content: ['<div class="layui-text" style="padding: 20px;">'
                ,'<blockquote class="layui-elem-quote">“签到”可获得社区飞吻，规则如下</blockquote>'
                ,'<table class="layui-table">'
                ,'<thead>'
                ,'<tr><th>连续签到天数</th><th>每天可获飞吻</th></tr>'
                ,'</thead>'
                ,'<tbody>'
                ,'<tr><td>＜5</td><td>5</td></tr>'
                ,'<tr><td>≥5</td><td>10</td></tr>'
                ,'<tr><td>≥15</td><td>15</td></tr>'
                ,'<tr><td>≥30</td><td>20</td></tr>'
                ,'</tbody>'
                ,'</table>'
                ,'<ul>'
                ,'<li>中间若有间隔，则连续天数重新计算</li>'
                ,'<li style="color: #FF5722;">不可利用程序自动签到，否则飞吻清零</li>'
                ,'</ul>'
                ,'</div>'].join('')
        });
    });
</script>