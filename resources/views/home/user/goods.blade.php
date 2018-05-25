@extends('layouts.main')

@section('container')
  <div class="layui-container fly-marginTop fly-user-main">
  @include('home.user.main')
      <style>
          .layui-field-title {
              margin: 10px 0 20px;
              border-width: 1px 0 0;
          }
          .layui-elem-field {
              margin-bottom: 10px;
              padding: 0;
              border-width: 1px;
              border-style: solid;
          }
          .goods-inf {
              border: 1px solid #EEEEEE;
              text-align: center;
              padding-top: 20px;
              padding-bottom: 20px;
          }
          .goods-inf-img {
              position: relative;
              width: 120px;
              margin: 0 auto;
          }
          .hat {
              position: relative;
              width: 80px;
              height: 80px;
              top: -8px;
          }
          .goods-inf .headImg {
              margin-top: -65px;
              margin-bottom: 10px;
              border-radius: 100%;
              height: 80px;
              width: 80px;
              border: 1px solid #eeeeee;
          }

          .ok{
              color: #009688;
              font-size: 30px;
          }


      </style>
  <div class="fly-panel fly-panel-user">
    <div class="layui-tab layui-tab-brief">
        <div class="layui-container content" style="border: 1px solid lightgray;background-color: white;width: 100%">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;border-bottom: none">
                <legend>我的物品</legend>
            </fieldset>
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this">全部</li>
                    @foreach($types as $type)
                        <li class="">{{ $type->name }}</li>
                    @endforeach
                </ul>
                <div class="layui-tab-content" style="height: auto">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-row">
                            @foreach($goods as $good)
                                <div class="layui-col-xs6 layui-col-sm4 layui-col-md3 layui-col-lg2">
                                    <div class="goods-inf" goods_id="{{ $good->id }}" @if($good->type->name == '头饰'||'徽章') style="cursor: pointer;height: 150px;@if(Auth::user()->useGoods->contains($good)) border: 1px solid #009688; @endif" onclick="useGoods(this,{{ $good->id }})" @endif>
                                        @if($good->type->name == '头饰')
                                            <div class="goods-inf-img;">
                                                <img class="hat" draggable="false" src="{{ $good->img }}">
                                                <img draggable="false" class="headImg" src="{{ url('/assets/images/default_avatar.png') }}">
                                            </div>
                                            <a style="color:red;display: block;">{{ $good->name }}</a>
                                        @else
                                            <div class="goods-inf-img" style="height:107px;line-height: 107px;@if($type->name == '徽章') cursor: pointer; @endif">
                                                <img draggable="false" src="{{ $good->img }}" style="max-width: 130px;max-width: 130px">
                                            </div>
                                            <a style="color:red;display: block;">{{ $good->name }}</a>
                                        @endif
                                        @if(Auth::user()->useGoods->contains($good))<i class="layui-icon layui-icon-ok ok" >&#xe605;</i>@endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach($types as $type)
                        <div class="layui-tab-item" style="min-height: 200px">
                            @if($goods->count())
                                @foreach($goods as $good)
                                    <div class="layui-col-xs6 layui-col-sm4 layui-col-md3 layui-col-lg2">
                                        @if($good->type_id == $type->id)
                                            @if($type->name == '头饰')
                                            <div class="goods-inf" style="cursor: pointer;height: 150px;@if(Auth::user()->useGoods->contains($good))border: 1px solid #009688;" onclick="useGoods(this,{{ $good->id }})" @endif>
                                                <div class="goods-inf-img">
                                                    <img class="hat" draggable="false" src="{{ $good->img }}">
                                                    <img draggable="false" class="headImg" src="{{ url('/assets/images/default_avatar.png') }}">
                                                </div>
                                                <a style="color:red;display: block;">{{ $good->name }}</a>
                                                @if(Auth::user()->useGoods->contains($good))<i class="layui-icon layui-icon-ok ok" >&#xe605;</i>@endif
                                            </div>
                                            @else
                                            <div class="goods-inf" @if($type->name == '徽章') style="cursor: pointer;height: 150px;@if(Auth::user()->useGoods->contains($good))border: 1px solid #009688;@endif" onclick="useGoods(this,{{ $good->id }})" @endif>
                                                <div class="goods-inf-img" style="height:107px;line-height: 107px;">
                                                    <img draggable="false" src="{{ $good->img }}" style="max-width: 130px;max-width: 130px">
                                                </div>
                                                <a style="color:red;display: block;">{{ $good->name }}</a>
                                                @if(Auth::user()->useGoods->contains($good))<i class="layui-icon layui-icon-ok ok" >&#xe605;</i>@endif
                                            </div>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <li style="text-align: center;">
                                    <div class="fly-list-info" style="line-height: 200px">
                                        <span style="font-size: 25px"><b>你还没有兑换的商品...</b></span>
                                    </div>
                                </li>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
  <script>
      function useGoods(obj,goods_id) {
          var target = $(obj);
          $.ajax({
              url:"/user/goods/"+goods_id+'/useGoods',
              type:'post',
              success:function (res) {
                  if (res.error == 0){
                      location.reload();
                  }
              }
          });
      }
  </script>
@endsection