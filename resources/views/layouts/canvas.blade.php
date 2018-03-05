<canvas id="canvas-banner" style="background: #393D49;"></canvas>
<!--为了及时效果需要立即设置canvas宽高，否则就在home.js中设置-->
<script type="text/javascript">
    var canvas = document.getElementById('canvas-banner');
    canvas.width = window.document.body.clientWidth - 10;//减去滚动条的宽度
    $('#canvas-banner').css('width',canvas.width);
    if (screen.width >= 992) {
        canvas.height = window.innerHeight * 1 / 3;
    } else {
        canvas.height = window.innerHeight * 2 / 7;
    }
</script>