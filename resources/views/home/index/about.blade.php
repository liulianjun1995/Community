@extends('layouts.main')

@section('container')
    <link rel="stylesheet" href="{{ asset('/assets/css/about.css') }}">
    <div class="blog-body">
        <div class="layui-container content">
            <div class="about-main">
                <div class="layui-tab layui-tab-brief shadow" lay-filter="tabAbout">
                    <ul class="layui-tab-title">
                        <li lay-id="1" class="layui-this">关于本站</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <div class="aboutinfo">
                                <div class="aboutinfo-figure">
                                    <img src="{{ asset('assets/images/1491.gif') }}" alt="{{ config('home.site.name') }}" width="200px" height="100px"/>
                                </div>
                                <p class="aboutinfo-nickname">{{ config('home.site.name') }}</p>
                                <p class="aboutinfo-introduce">{{ config('home.user.introduce') }}</p>
                                <p class="aboutinfo-location"><i class="fa fa-link"></i>&nbsp;&nbsp;<a target="_blank" href="/">www.lxshequ.com</a></p>
                                <fieldset class="layui-elem-field layui-field-title">
                                    <legend>简介</legend>
                                    <div class="layui-field-box aboutinfo-abstract">
                                        <p style="text-align:center;">
                                            本社区基于Layui社区开发
                                        </p>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection