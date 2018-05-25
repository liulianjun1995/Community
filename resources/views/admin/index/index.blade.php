<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>社区后台管理系统</title>
    <link rel="shortcut icon" href="{{ asset('/assets/images/1491.gif') }}">
    <!-- layui.css -->
    <link href="/assets/plugin/layui/css/layui.css" rel="stylesheet" />
    <!-- font-awesome.css -->
    <link href="/assets/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- 本页样式 -->
    <link href="/assets/css/main.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/uploadify/uploadify.css') }}" />
    <!-- jquery -->
    <script src="/assets/js/jquery-2.1.4.js"></script>
    <!-- layui.js -->
    <script src="/assets/plugin/layui/layui.js"></script>
    <script type="text/javascript" src="{{ asset('assets/uploadify/jquery.uploadify.js') }}"></script>

</head>
<body>
    <div class="layui-layout layui-layout-admin">
        <!--顶部-->
        @include('admin.layouts.header')
        <!--侧边导航-->
        @include('admin.layouts.leftNav')
        <!--收起导航-->
        <div class="layui-side-hide layui-bg-cyan">
            <i class="fa fa-long-arrow-left fa-fw"></i>收起导航
        </div>
        <!--主体内容-->
        @include('admin.layouts.body')
        <!--底部信息-->
        <div class="layui-footer">
            <p style="line-height:44px;text-align:center;">社区后台管理系统</p>
        </div>
        <!--快捷菜单-->
        @include('admin.layouts.shortMenu')
        <!--个性化设置-->
        @include('admin.layouts.individuation')
    </div>

    <script type="text/javascript">
        layui.config({
            base: '/assets/js/'
        }).use('main');
        //获取IP
        $.getScript('http://pv.sohu.com/cityjson?ie=utf-8', function(){
            $('#ip').text('IP：'+returnCitySN.cip);
        });
        //获取地址
        $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function(){
            $('#address').text('地点：'+remote_ip_info.province+" "+remote_ip_info.city);
        });
        $("#time").text();
    </script>
    <!-- 获取时间 -->
    <script>
        function getTime(){
            var time = new Date();//获取系统当前时间
            var year = time.getFullYear();
            var month = time.getMonth()+1;
            var date= time.getDate();//系统时间月份中的日
            var day = time.getDay();//系统时间中的星期值
            var weeks = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
            var week = weeks[day];//显示为星期几
            var hour = time.getHours();
            var minutes = time.getMinutes();
            var seconds = time.getSeconds();
            if(month<10){
                month = "0"+month;
            }
            if(date<10){
                date = "0"+date;
            }
            if(hour<10){
                hour = "0"+hour;
            }
            if(minutes<10){
                minutes = "0"+minutes;
            }
            if(seconds<10){
                seconds = "0"+seconds;
            }
            //var newDate = year+"年"+month+"月"+date+"日"+week+hour+":"+minutes+":"+seconds;
            document.getElementById("time").innerHTML = "时间："+year+"-"+month+"-"+date+" "+week+" "+hour+":"+minutes+":"+seconds;
            setTimeout('getTime()',1000);
        }
        getTime();
    </script>
</body>
</html>