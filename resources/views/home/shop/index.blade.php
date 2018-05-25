@extends('layouts.main')

@section('container')
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


    </style>
    <div class="layui-container content" style="border: 1px solid lightgray;background-color: white">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;border-bottom: none">
            <legend>积分兑换</legend>
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
                            <div class="goods-inf">
                                @if($good->type->name == '头饰')
                                <div class="goods-inf-img" >
                                    <img class="hat" draggable="false" src="{{ $good->img }}">
                                    <img draggable="false" class="headImg" src="{{ url('/assets/images/default_avatar.png') }}">
                                </div>
                                @else
                                <div class="goods-inf-img" style="height:107px;line-height: 107px">
                                    <img draggable="false" src="{{ $good->img }}" style="max-width: 130px;max-width: 130px">
                                </div>
                                @endif
                                <span style="color: #FF5722;">{{ $good->price }} 飞吻</span> <br>
                                @login
                                    @if(Auth::user()->goods->contains($good))
                                        <span style="color: mediumspringgreen;font-size: 20px">已拥有</span>
                                    @else
                                        <button onclick="buyGoods({{ $good->id }},{{ $good->price }})" class="layui-btn layui-btn-normal layui-btn-sm">兑换</button>
                                    @endif
                                @else
                                <button onclick="layer.msg('请先登录')" class="layui-btn layui-btn-normal layui-btn-sm">兑换</button>
                                @endlogin
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @foreach($types as $type)
                <div class="layui-tab-item" style="min-height: 200px">
                    @if($type->goods->count())
                    @foreach($type->goods as $good)
                        <div class="layui-col-xs6 layui-col-sm4 layui-col-md3 layui-col-lg2">
                            <div class="goods-inf">
                                @if($type->name == '头饰')
                                <div class="goods-inf-img">
                                    <img class="hat" draggable="false" src="{{ $good->img }}">
                                    <img draggable="false" class="headImg" src="{{ url('/assets/images/default_avatar.png') }}">
                                </div>
                                @else
                                <div class="goods-inf-img" style="height:107px;line-height: 107px">
                                    <img draggable="false" src="{{ $good->img }}" style="max-width: 130px;max-width: 130px">
                                </div>
                                @endif
                                <span style="color: #FF5722;">{{ $good->price }} 飞吻</span> <br>
                                @login
                                    @if(Auth::user()->goods->contains($good))
                                        <span style="color: mediumspringgreen;font-size: 20px">已拥有</span>
                                    @else
                                        <button onclick="buyGoods({{ $good->id }},{{ $good->price }})" class="layui-btn layui-btn-normal layui-btn-sm">兑换</button>
                                    @endif
                                @else
                                <button onclick="layer.msg('请先登录')" class="layui-btn layui-btn-normal layui-btn-sm">兑换</button>
                                @endlogin
                            </div>
                        </div>
                    @endforeach
                        @else
                        <li style="text-align: center;">
                            <div class="fly-list-info" style="line-height: 200px">
                                <span style="font-size: 25px"><b>敬请期待...</b></span>
                            </div>
                        </li>
                        @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @login
    <script>
        function buyGoods(goods_id,price) {
            $myReward = {{ Auth::user()->reward }};
            if ($myReward < price){
                layer.msg('您的积分不够，继续努力吧~~');
                return false;
            }
            $.ajax({
                url:'/user/changeGoods',
                type:'post',
                data:{'goods_id':goods_id},
                success:function (res) {
                    if (res.error == 0){
                        layer.msg(res.msg);
                    }else {
                        layer.msg(res.msg);
                    }
                }
            });
        }
    </script>
    @endlogin
@endsection