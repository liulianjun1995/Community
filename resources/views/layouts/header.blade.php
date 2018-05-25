<style>
    .layui-layer-tips{
        position: fixed !important;
    }
</style>
<div class="fly-header layui-bg-black">
    <div class="layui-container">
            <a class="fly-logo" href="/">
                <img src="{{ asset('/assets/images/1491.gif') }}" alt="lxshequ" height="39px" width="100px">
            </a>
            <ul class="layui-nav fly-nav layui-hide-xs" style="margin-left: 120px">
                <li class="layui-nav-item layui-this home">
                    <a href="/"><i class="iconfont icon-shouye" style="top: 0px"></i>首页</a>
                </li>
                {{--<li class="layui-nav-item shoucang">--}}
                    {{--<a href="#"><i class="iconfont icon-shichang" style="top: 2px;"></i>收藏驿站</a>--}}
                {{--</li>--}}
                <li class="layui-nav-item jifen">
                    <a href="{{ url('/shop') }}"><i class="iconfont icon-iconmingxinganli"></i>积分商城</a>
                </li>
                <li class="layui-nav-item github">
                    <a target="_blank" href="https://github.com/liulianjun1995/Comunity"><i class="layui-icon"></i>GitHub</a>
                </li>
                <li class="layui-nav-item about">
                    <a href="#"><i class="iconfont icon-wenda"></i>关于</a>
                </li>
            </ul>

            <ul class="layui-nav fly-nav-user">
                @login
                <li class="layui-nav-item">
                    <a class="fly-nav-avatar" href="/user/{{ Auth::user()->id }}/home">
                        <cite class="layui-hide-xs">{{ Auth::user()->name }}@admin<span style="color:#c00;">（管理员）</span>@endadmin</cite>
                        {{--<i class="iconfont icon-renzheng layui-hide-xs" title="认证信息：lxshequ 作者"></i>--}}
                        {{--<i class="layui-badge fly-badge-vip layui-hide-xs">VIP3</i>--}}
                        @if(\App\Model\UserUseGoods::where('user_id',Auth::user()->id)->where('type_id','6')->get()->count())
                            <img src="{{ \App\Model\Goods::where('id',\App\Model\UserUseGoods::where('type_id','6')->first()['goods_id'])->first()['img'] }}" style="display: inline-block;position:absolute;margin-top: 2px" draggable="false">
                        @endif
                        <img src="{{ Auth::user()->avatar }}">
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="/user/index"><i class="layui-icon">&#xe612;</i>用户中心</a></dd>
                        <dd><a href="/user/set/info"><i class="layui-icon">&#xe620;</i>基本设置</a></dd>
                        <hr style="margin: 5px 0;">
                        <dd><a href="/user/message"><i class="iconfont icon-tongzhi" style="top: 4px;"></i>我的消息</a></dd>
                        <dd><a href="/user/{{ Auth::user()->id }}/home"><i class="layui-icon" style="margin-left: 2px; font-size: 22px;">&#xe68e;</i>我的主页</a></dd>
                        <hr style="margin: 5px 0;">
                        <dd><a href="/user/logout" style="text-align: center;">退出</a></dd>
                    </dl>
                    @if(count(Auth::user()->newMessages))
                    <a class="fly-nav-msg" id="msg" href="{{ url('/user/message') }}">{{ count(Auth::user()->newMessages) }}</a>
                    @endif
                </li>
                @else
                    <li class="layui-nav-item">
                        <a class="iconfont icon-touxiang layui-hide-xs" href="/user/login"></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="{{ url('/user/login') }}">登入</a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="/user/reg">注册</a>
                    </li>
                @endlogin
            </ul>

        </div>
    <script>
        //消息tips
        var msg = $('#msg');
        if (msg.length>0){
            var num = msg.text();
            layer.tips('您有'+num+'条未读消息', '#msg', {
                tips: [3, '#000000'],
                time: 4000
            });
        }
        layui.use('element', function(){
            var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
        });
    </script>
</div>