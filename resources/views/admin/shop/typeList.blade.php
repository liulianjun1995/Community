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
                            <div class="layui-input-inline" style="margin: 0 auto">
                                <a href="{{ url('/admin/goodsType/create') }}" class="layui-btn layui-btn-normal">添加商品种类</a>
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
                        <col width="200">
                        <col width="10">
                        <col width="10">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>种类名称</th>
                        <th>添加时间</th>
                        <th COLSPAN="2">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr>
                            <td>{{$type->id}}</td>
                            <td>{{$type->name}}</td>
                            <td>{{$type->created_at}}</td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="window.location.href='/admin/goodsType/{{ $type->id }}/editType'">
                                    修改
                                </button>
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="delType(this,{{ $type->id }})">
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
        function delType(obj,type_id){
            layer.confirm('是否删除？', {
                btn: ['是','否'] //按钮
            }, function(){
                //删除
                $.ajax({
                    url:'/admin/goodsType/'+type_id+"/delete",
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
    </script>
@endsection