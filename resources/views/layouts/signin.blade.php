<style>
    .sign-in {
        width: 100%;
        height: 76px;
        position: relative;
        font-family: 微软雅黑;
        background: url({{ asset('/assets/images/sign-in.png') }}) no-repeat;
        cursor: pointer;
    }
    .sign-in .datetime {
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        padding: 10px 0 10px 60px;
    }
    .sign-in .date {
        color: #fff;
        font-size: 14px;
        margin: 0 0 5px 0;
    }
    .sign-in em, .sign-in-h em {
        font-style: normal;
        display: block;
    }
    .sign-in .week {
        color: #ffe200;
        font-size: 18px;
    }
    .sign-in .days, .sign-in-h .days {
        position: absolute;
        right: 0px;
        top: 10px;
    }
    .sign-in .day {
        color: #fff;
        font-size: 14px;
        margin: 0 0 3px 0;
    }
    .sign-in .num {
        color: #ffe200;
        font-size: 20px;
        text-align: center;
    }
    .sign-in .btn-sign {
        color: #edfba2;
        left: 150px;
    }
    .sign-in .btn-sign, .sign-in-h .btn-sign-h {
        font-size: 26px;
        position: absolute;
        top: 16px;
        display: block;
        outline: none;
        cursor: pointer;
        width: 80px;
        text-align: center;
    }
    .sign-wrap {
        position: absolute;
        top: 70px;
        left: 0;
        z-index: 1;
        width: 100%;
    }
    .sign-box {
        padding: 10px;
        color: #fff;
        background: #1ab96a;
        border-radius: 4px;
    }
    .sign-box h3 {
        font-size: 16px;
        color: rgb(255, 255, 255);
        font-family: 微软雅黑;
        padding: 0px 0px 5px;
    }
    .margin-top {
        margin-top: 10px;
    }
    .sign-info {
        margin: 5px 0 0 0;
        font-size: 12px;
    }
    #con_num, #total_num {
        font-weight: bold;
    }
</style>
<div class="fly-panel fly-signin" style="height: auto">
    <div class="fly-panel-title">
        签到
        <i class="fly-mid"></i>
        <a href="javascript:;" class="fly-link" id="LAY_signinHelp">说明</a>
        <i class="fly-mid"></i>
        <a href="javascript:;" class="fly-link" id="LAY_signinTop">活跃榜<span class="layui-badge-dot"></span></a>
    </div>
    @login
    <div class="fly-panel-main fly-signin-main layui-bg-green" style="height: auto">
        <div class="sign-in" id="checkdiv" @if(Auth::user()->is_sign()) onmouseenter="signEnter()" onmouseleave="signLeave()" @endif>
			<span class="datetime"><em class="date">{{ date('m') }}.{{ date('d') }}</em>
			<em class="week"></em></span>
            <span class="days">
			<em class="day">DAYS</em><em class="num" id="con_num_day">{{ Auth::user()->total_sign_day }}</em></span>
            <em href="javascript:void(0)"  id="signin" class="btn-sign">@if(Auth::user()->is_sign())已签到@else签到@endif</em>
            <div class="sign-wrap is-sign" style="display: none;" id="checkdetail">
                <div class="sign-box margin-top">
                    <h3 id="checkinfo">今日签到成功，获得{{ Auth::user()->todaySignReward }}飞吻</h3>
                    <div class="sign-info"><p>已连续签到<font id="con_num">{{ Auth::user()->total_sign_day }}</font> 天</div>
                </div>
            </div>
            <div class="sign-gun" id="sign-gun"></div>
        </div>
    </div>
    @else
    <div class="fly-panel-main fly-signin-main layui-bg-green" style="height: auto">
            <div class="sign-in" id="checkdiv">
			<span class="datetime"><em class="date">{{ date('m') }}.{{ date('d') }}</em>
			<em class="week"></em></span>
                <span class="days">
			<em class="day">DAYS</em><em class="num" id="con_num_day">0</em></span>
                <em href="javascript:void(0)" onclick="layer.msg('请先登录')" class="btn-sign">签到</em>
                <div class="sign-wrap is-sign" style="display: none;" id="checkdetail">
                    <div class="sign-box margin-top">
                        <h3 id="checkinfo">今日签到成功，获得飞吻</h3>
                        <div class="sign-info"><p>已连续签到<font id="con_num">1</font> 天</div>
                    </div>
                </div>
                <div class="sign-gun" id="sign-gun"></div>
            </div>
        </div>
    @endlogin
</div>

<script>
    //获取时间
    $(function () {
        var str = "周";
        var d = new Date();
        switch (d.getDay()){
            case 0:
                str=str+"日";
                break;
            case 1:
                str=str+"一";
                break;
            case 2:
                str=str+"二";
                break;
            case 3:
                str=str+"三";
                break;
            case 4:
                str=str+"四";
                break;
            case 5:
                str=str+"五";
                break;
            case 6:
                str=str+"六";
                break;
        }
       $('.week').text(str);
    });
    //签到说明
    var elemSigninHelp = $('#LAY_signinHelp');
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
    //签到
    $("#signin").click(function () {
        $.ajax({
            url:"/user/{{ Auth::id() }}/signin",
            type:"post",
            dataType:"json",
            success:function (res) {
                if(res.error == 1){
                    //签到成功
                    $("#checkdiv").attr('onmouseenter','signEnter()');
                    $("#checkdiv").attr('onmouseleave','signLeave()');
                    $("#con_num_day").text(res.total_sign_day);
                    $("#checkinfo").text('今日签到成功，获得'+res.addReward+'飞吻');
                    $("#con_num").text(res.total_sign_day);
                    $("#signin").text('已签到');
                    document.getElementById('checkdiv').style.height = '150px';
                    document.getElementById('checkdetail').style.display = 'block';
                    layer.msg('签到成功');
                }else if(res.error == 0){
                    layer.msg(res.msg);
                }
            },
            error:function () {
                layer.msg('请求失败，请重试')
            }
        });

    });
    //鼠标移入
    function signEnter() {
        //layer.msg('移入');
        document.getElementById('checkdiv').style.height = '150px';
        document.getElementById('checkdetail').style.display = 'block';
    }
    //鼠标移出
    function signLeave() {
        //layer.msg('移出');
        document.getElementById('checkdiv').style.height = '76px';
        document.getElementById('checkdetail').style.display = 'none';
    }
</script>