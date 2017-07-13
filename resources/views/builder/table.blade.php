@extends('layouts.app')

@section('title','MyAdmin - 节点管理')

@section('sidebar')
    @parent
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
                            <li><a href="/admin/system/index">{{$moduleName}}</a></li>
                            <li><a href="/admin/system/index">控制台</a></li>
                            @foreach($NodeCrumb['Crumb'] as $key=>$value)
                                <li>
                                    <a href="@if($value->Href) /{{$value->Href}} @else{{'javascript:;'}}@endif">{{$value->NodeName}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        @include('builder.widget.search')

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
            <div class="block-title clearfix">
                <div class="block-options pull-left">
                    @include('builder.widget.topbtn')
                </div>

                <div class="block-options pull-right">
                    <div id="style-borders" class="btn-group">
                        @if($isSearch)
                            <a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary"
                               id="openSearch">搜索</a>
                        @endif
                    </div>
                </div>

            </div>

            <div class="table-responsive">
                @if($listData)
                    <table id="general-table"
                           class="table table-vcenter table-borderless table-striped table-condensed table-hover">
                        <thead>
                        <tr>
                            <th style="width: 80px;" class="text-center">
                                <label id="allChoose" class="csscheckbox csscheckbox-primary">
                                    <input type="checkbox"><span></span>
                                </label>
                            </th>
                            @foreach($column as $key=>$item)
                                <th style="font-size: 13.5px;">{{$item['name']}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($listData as $key=>$item)
                            <tr>
                                <td class="text-center">
                                    <label class="csscheckbox csscheckbox-primary">
                                        <input name="checkbox" type="checkbox" value="{{$item[$listKey]}}">
                                        <span></span>
                                    </label>
                                </td>

                                @foreach($column as $key=>$col)
                                    @if($col['type'] == 'default')
                                        @include('builder.widget.default')
                                    @elseif($col['type'] == 'btn')
                                        @include('builder.widget.btn')
                                    @elseif($col['type'] == 'date')
                                        @include('builder.widget.date')
                                    @elseif($col['type'] == 'url')
                                        @include('builder.widget.url')
                                    @elseif($col['type'] == 'state')
                                        @include('builder.widget.state')
                                    @else
                                        @include('builder.widget.default')
                                    @endif
                                @endforeach

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @else
                    <p style="text-align: center;"><i class="fa fa-battery-1"></i>&nbsp;没有相关内容</p>
                @endif
            </div>
            {{$page}}
        </div>
    </div>
@endsection



@section('scripts')
    @include('builder.widget.scripts.topbtn')
    @include('builder.widget.scripts.rightbtn')

    <script src="/asstes/js/pages/uiTables.js"></script>
    <script>
        $(function () {

            UiTables.init();

            $('#openSearch').on('click', function () {
                $('#search').toggle();
            });


            $('#allChoose').on('change', function () {
                var allChoose = "";

                $('input:checkbox[name="checkbox"]:checked').each(function (i) {
                    if (0 == i) {
                        allChoose = $(this).val();
                    } else {
                        allChoose += ("," + $(this).val());
                    }
                });


            });
        });
    </script>
@endsection