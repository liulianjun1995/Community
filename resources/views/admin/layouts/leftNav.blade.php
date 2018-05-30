<div class="layui-side">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree" lay-filter="leftnav">
            <li class="layui-nav-item layui-this">
                <a href="javascript:;"><i class="fa fa-home"></i>首页</a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-file-text"></i>内容管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" data-url="/admin/posts" data-id="1">帖子管理</a></dd>
                    <dd><a href="javascript:;" data-url="/admin/categoriesList" data-id="2">版块管理</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-user"></i>用户管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" data-url="/admin/userList" data-id="3">全部用户</a></dd>
                    <dd><a href="javascript:;" data-url="/admin/adminList" data-id="4">管理员列表</a></dd>
                    <dd><a href="javascript:;" data-url="/admin/roleList" data-id="5">角色管理</a></dd>
                    <dd><a href="javascript:;" data-url="/admin/permissionList" data-id="6">权限管理</a></dd>
                    <dd><a href="javascript:;" data-url="/admin/gagList" data-id="7">禁言管理</a></dd>
                    <dd><a href="javascript:;" data-url="/admin/defriendList" data-id="8">黑名单管理</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="fa fa-user"></i>商城管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" data-url="/admin/goodsList" data-id="9">商品列表</a></dd>
                    <dd><a href="javascript:;" data-url="/admin/goodsTypeList" data-id="10">商品类别列表</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>