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
                                <a href="{{ url('/admin/category/create') }}" class="layui-btn layui-btn-normal">添加版块</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;text-align: center">
        <legend id="articleBoxTitle">板块列表</legend>
        <div class="layui-field-box">
            <div id="articleContent" class="">
                <table style="width: auto;margin: 0 auto" class="layui-table" lay-even="">
                    <colgroup>
                        <col width="50">
                        <col width="80">
                        <col width="200">
                        <col width="10">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>名称</th>
                        <th>描述</th>
                        <th COLSPAN="2">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->describe}}</td>
                            <td>
                                <button class="layui-btn layui-btn-small layui-btn-normal" onclick="window.location.href='/admin/category/{{$category->id}}/edit'">
                                    修改
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
            var layer = layui.layer;
        });

    </script>
@endsection