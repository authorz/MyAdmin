@extends('layouts.app')

@section('title','MyAdmin - 节点管理')

@section('sidebar')
    @parent
@endsection

@section('csses')
    <link rel="stylesheet" href="/plugin/fileinput/css/fileinput.css">
    <link rel="stylesheet" href="/plugin/fileinput/themes/explorer/theme.css">
@endsection

@section('content')
    <div id="page-content">

        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1 style="font-size:20px;">{{ $nodeName }}</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            @foreach($crumb['data'] as $key=>$val)
                                <li><a href="{{$val['url']}}">{{$val['name']}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

                <div class="block">
                    @if($nav)
                        <div class="block-title">
                            <ul class="nav nav-tabs">
                                @foreach($nav as $key=>$item)
                                    <li @if( ($key == 0 && empty($_GET[$navPrefix])) || ($_GET[$navPrefix] == $item['value']))class="active"@endif>
                                        <a href="{{$item['url']}}">{{$item['name']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="block-title">
                        <!--                    <div class="block-options pull-right">-->
                        <!--                        <a href="javascript:void(0)"-->
                        <!--                           class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip" data-toggle="button"-->
                        <!--                           title="简化"><i class="fa fa-bars"></i></a>-->
                        <!--                    </div>-->
                        <h2>{{$nodeName}}</h2>
                    </div>

                    <form action="{{$url}}" method="{{$way}}" name="form"
                          class="form-horizontal form-bordered" id="form-validation"
                          @if($isAjax) onsubmit="return false;" @endif enctype="multipart/form-data"
                          style="margin: 0px -11px 2px;">
                        @if($isAjax == FALSE) {{ csrf_field() }} @endif
                        @foreach($receive as $key=>$item)
                            @if($item['type'] == 'hidden')
                                @include('builder.widget.hidden')
                            @elseif($item['type'] == 'text')
                                @include('builder.widget.text')
                            @elseif($item['type'] == 'password')
                                @include('builder.widget.password')
                            @elseif($item['type'] == 'textarea')
                                @include('builder.widget.textarea')
                            @elseif($item['type'] == 'radio')
                                @include('builder.widget.radio')
                            @elseif($item['type'] =='checkbox')
                                @include('builder.widget.checkbox')
                            @elseif($item['type'] == 'select')
                                @include('builder.widget.select')
                            @elseif($item['type'] == 'color')
                                @include('builder.widget.color')
                            @elseif($item['type'] == 'date')
                                @include('builder.widget.tables.date')
                            @elseif($item['type'] == 'time')
                                @include('builder.widget.tables.time')
                            @elseif($item['type'] == 'tags')
                                @include('builder.widget.tables.tags')
                            @elseif($item['type'] == 'upload')
                                @include('builder.widget.tables.upload')
                            @elseif($item['type'] == 'ueditor')
                                @include('builder.widget.tables.ueditor')
                            @endif
                        @endforeach

                        <div class="form-group form-actions" style="margin-bottom:7px;">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-effect-ripple btn-primary">提交</button>
                                <button type="reset" class="btn btn-effect-ripple btn-danger"
                                        style="margin-left: 10px;">
                                    重置
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

        @if($block)
            <blockquote style="word-wrap:break-word">
                {{$block}}
            </blockquote>
        @endif

    </div>
@endsection



@section('scripts')
    <script src="/plugin/ueditor/ueditor.config.js"></script>
    <script src="/plugin/ueditor/ueditor.all.min.js"></script>
    <script src="/plugin/ueditor/lang/zh-cn/zh-cn.js"></script>

    <script src="/plugin/fileinput/js/plugins/canvas-to-blob.min.js"></script>
    <script src="/plugin/fileinput/js/plugins/sortable.min.js"></script>
    <script src="/plugin/fileinput/js/plugins/purify.min.js"></script>
    <script src="/plugin/fileinput/js/fileinput.min.js"></script>
    <script src="/plugin/fileinput/themes/explorer/theme.js"></script>
    <script src="/plugin/fileinput/js/locales/zh.js"></script>



    @include('builder.widget.tables.scripts.upload')
    @include('builder.widget.tables.scripts.ueditor')
    @include('builder.widget.tables.scripts.submit')
@endsection
