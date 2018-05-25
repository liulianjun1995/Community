<div class="layui-body">
    <div style="margin:0;position:absolute;top:4px;bottom:0px;width:100%;" class="layui-tab layui-tab-brief" lay-filter="tab" lay-allowclose="true">
        <ul class="layui-tab-title">
            <li lay-id="0" class="layui-this">首页</li>
        </ul>
        <div class="layui-tab-content">

            <div class="layui-tab-item layui-show">
                <p style="padding: 10px 15px; margin-bottom: 20px; margin-top: 10px; border:1px solid #ddd;display:inline-block;">
                    本次登陆
                    <span style="padding-left:1em;" id="ip"></span>
                    <span style="padding-left:1em;" id="address">地点：XX</span>
                    <span style="padding-left:1em;" id="time"></span>
                </p>
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>统计信息</legend>
                    <div class="layui-field-box">
                        <div style="display: inline-block; width: 100%;">
                            <div class="ht-box layui-bg-blue">
                                <p>123</p>
                                <p>用户总数</p>
                            </div>
                            <div class="ht-box layui-bg-red">
                                <p>32</p>
                                <p>今日注册</p>
                            </div>
                            <div class="ht-box layui-bg-green">
                                <p>55</p>
                                <p>今日登陆</p>
                            </div>
                            <div class="ht-box layui-bg-orange">
                                <p>123</p>
                                <p>帖子总数</p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>