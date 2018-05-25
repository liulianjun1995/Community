@extends('admin.layouts.main')
@section('content')
    <fieldset id="articleList" class="layui-elem-field layui-field-title sys-list-field" style="display:block;">
        <legend id="articleBoxTitle" style="text-align: center">添加商品</legend>
        <div class="layui-field-box">
            <div>
                <form id="createForm" class="layui-form form-main" style="width:70%;margin: 0 auto;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">商品名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name"  lay-verify="name" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">商品分类</label>
                        <div class="layui-input-block">
                            <select name="type" lay-verify="required">
                                <option value=""></option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">商品数量</label>
                        <div class="layui-input-inline" style="width: 120px;">
                            <input type="text" name="number" lay-verify="number" placeholder="1-100000" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">商品价格</label>
                        <div class="layui-input-inline" style="width: 120px;">
                            <input type="text" name="price" lay-verify="price" placeholder="1-100000飞吻"  autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item" style="position:relative;">
                        <label class="layui-form-label">商品图片</label>
                        <div class="layui-input-inline">
                            <input id="goodsImgSrc" name="goodsImgSrc" type="hidden">
                            <img id="goodsImg" width="192px" height="128px" class="img-cover" src="{{ asset('/assets/images/cover_default.jpg') }}" alt="封面">
                        </div>
                        <div class="layui-box layui-upload-button" style="position:absolute;bottom:-15px;left: 350px">
                            <div class="layui-box">
                                <input type="file" name="uploads" id="uploads">
                                <input type="hidden" name="img" id="imgs">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">是否启用</label>
                        <div class="layui-input-block">
                            <input type="checkbox" checked="" name="is_use" lay-skin="switch" lay-filter="switchTest" title="开关">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="addType">添加</button>
                            <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.go(-1)">返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <script>
        $(function() {
            $('#uploads').uploadify({
                swf      : '{{ asset('assets/uploadify/uploadify.swf') }}',
                uploader : '/admin/upload',
                buttonText : '上传照片',
                fileTypeExts : '*.jpg;*.jpeg;*.png;*.gif',
                formData     : {
                    '_token': '{{ csrf_token() }}',
                    'files' : 'goodsImg'
                },
                onUploadSuccess : function (file,data,response) {
                    //展示图片
                    $("#goodsImg").attr('src',data.substring(0,data.indexOf('<link')));
                    //隐藏传递数据
                    $("#imgs").val(data);
                },
                onUploadError: function(file, errorCode, errorMsg, errorString) { // 上传失败回调函数
                    $("#imgs").val(data);
                    layer.alert('上传失败，请重试！');
                }
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        layui.use(['form'],function () {
            var form  = layui.form;
            form.verify({
                name:function (value) {
                    if (value.length < 2){
                        return '商品名称至少2个字符';
                    }
                    if (value.length > 10){
                        return '商品名称最多10个字符';
                    }
                },
                price:function (value) {
                    if (!/^\d+$/.test(value)){
                        return '商品价格必须为整数';
                    }
                    if (value < 1){
                        return '商品价格至少为1';
                    }
                    if (value > 100000){
                        return '商品价格最多为100000';
                    }
                },
                number:function (value) {
                    if (!/^\d+$/.test(value)){
                        return '商品数量必须为整数';
                    }
                    if (value < 1){
                        return '商品数量至少为1';
                    }
                    if (value > 100000){
                        return '商品数量最多为100000';
                    }
                },

            });

            //监听指定开关
            form.on('switch(switchTest)', function(data){
                layer.msg('商品：'+ (this.checked ? '启用' : '不启用'), {
                    offset: '6px'
                });
            });

            //监听提交
            form.on('submit(addType)', function(data){
                var fm = document.getElementById('createForm');
                var fd = new FormData(fm);
                fd.append('img',$("#goodsImg").attr('src'));
                $.ajax({
                    url:'/admin/goods/store',
                    type:'post',
                    data:fd,
                    processData:false,
                    contentType:false,
                    success:function (res) {
                        if (res == 1){
                            layer.msg('添加成功', {
                                icon: 1
                                ,time: 1000
                                ,shade: 0.1
                            }, function(){
                                window.location.href = '/admin/goodsList';
                            });
                        }else{
                            layer.msg('添加失败，请重试', {
                                time: 2500
                                ,shade: 0.2
                            });
                        }
                    },
                    error:function (res) {
                        var error = '';
                        if (res.responseJSON.errors.name != undefined){
                            error += res.responseJSON.errors.name+"<br>";
                        }
                        if (res.responseJSON.errors.type != undefined){
                            error += res.responseJSON.errors.type+"<br>";
                        }
                        if (res.responseJSON.errors.number != undefined){
                            error += res.responseJSON.errors.number+"<br>";
                        }
                        if (res.responseJSON.errors.price != undefined){
                            error += res.responseJSON.errors.price+"<br>";
                        }
                        if (res.responseJSON.errors.is_use != undefined){
                            error += res.responseJSON.errors.is_use+"<br>";
                        }
                        if (res.responseJSON.errors.img != undefined){
                            error += res.responseJSON.errors.img+"<br>";
                        }
                        layer.msg(error, {
                            time: 2500
                            ,shade: 0.2
                        });
                    }
                });
                return false;
            });
        });
    </script>
@endsection