@extends('admin.layouts.main')
@section('content')
    <!-- layui.css -->
    <fieldset id="articleConsole" class="layui-elem-field layui-field-title" style="display:block;text-align: center">
        <legend>控制台</legend>
        <div class="layui-field-box">
            <div id="articleIndexTop">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item" style="margin:0;margin-top:15px;">
                        <div class="layui-inline">
                            <div class="layui-input-inline" style="width:auto">
                                <a href="{{ url('/admin/goods/create') }}" class="layui-btn layui-btn-normal">添加商品</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;text-align: center">
        <legend id="articleBoxTitle">商品列表</legend>
        <div class="layui-field-box">
            <div id="articleContent" class="">
                <table style="width: auto;margin: 0 auto" class="layui-table" lay-even="">
                    <colgroup>
                        <col width="50">
                        <col width="100">
                        <col width="100">
                        <col width="100">
                        <col width="100">
                        <col width="200">
                        <col width="10">
                        <col width="10">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>名称</th>
                        <th>类别</th>
                        <th>数量</th>
                        <th>价格</th>
                        <th>图片</th>
                        <th>选项</th>
                        <th COLSPAN="2">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goods as $good)
                        <tr>
                            <td>{{$good->id}}</td>
                            <td>{{$good->name}}</td>
                            <td>{{$good->type->name}}</td>
                            <td>{{$good->number}}</td>
                            <td>{{$good->price}} 飞吻</td>
                            <td>
                                <img src="{{ $good->img }}" alt="">
                            </td>
                            <td>
                                <form class="layui-form" action="">
                                    <div class="layui-form-item" style="margin:0;">
                                        <input type="checkbox" name="is_use" title="启用">
                                        <div class="layui-unselect layui-form-checkbox @if($good->is_use) layui-form-checked @endif" value="{{ $good->is_use }}" onclick="isUse(this,{{ $good->id }})">
                                            <span>启用</span><i class="layui-icon"></i>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="window.location.href='/admin/goods/{{ $good->id }}/editGoods'">
                                    修改
                                </button>
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="delGoods(this,{{ $good->id }})">
                                    删除
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </fieldset>
    <script type="text/javascript">
        layui.use(['layer'],function () {
            var layer =  layui.layer;
        });
        function delGoods(obj,goods_id){
            layer.confirm('是否删除？', {
                btn: ['是','否'] //按钮
            }, function(){
                //删除
                $.ajax({
                    url:'/admin/goods/'+goods_id+"/delete",
                    method:"post",
                    success: function (result) {
                        if(result==1){
                            layer.msg('删除成功');
                            $(obj).parent().parent().remove();
                        }else{
                            layer.msg('删除失败，请重试');
                        }
                    }
                });
            }, function(){

            });
        }
        function isUse(obj,goods_id) {
            var target = $(obj);
            var is_use = target.attr('value') == 1 ?'0':'1';
            $.ajax({
                url:'/admin/goods/'+goods_id+"/isUse",
                method:"post",
                data:{'is_use':is_use},
                success: function (result) {
                    if(result == 1){
                        target.attr('value',is_use);
                        console.log(is_use);
                        if (is_use == '1'){
                            target.addClass('layui-form-checked');
                        }else{
                            target.removeClass('layui-form-checked');
                        }
                    }else{
                        layer.msg('操作失败，请重试');
                    }
                }
            });
        }
    </script>
@endsection