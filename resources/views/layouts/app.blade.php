<!DOCTYPE html>
<!--[if IE 9]>
<html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/asstes/css/plugins.css">
    <link rel="stylesheet" href="/asstes/css/main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link id="theme-link" rel="stylesheet" href="/asstes/css/themes/passion.css">
    <link rel="stylesheet" href="/asstes/css/themes.css">
    <!-- END Stylesheets -->

    <link rel="stylesheet" href="/plugin/toast/src/jquery.toast.css">

    @section('csses')

    @show

            <!-- Modernizr (browser feature detection library) -->
    <script src="/asstes/js/vendor/modernizr-3.3.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<!-- Page Wrapper -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available classes:

    'page-loading'      enables page preloader
-->
<div id="page-wrapper" class="page-loading">

    <div class="preloader">
        <div class="inner">
            <!-- Animation spinner for all modern browsers -->
            <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

            <!-- Text for IE9 -->
            <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
        </div>
    </div>

    <div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"><strong>配色切换</strong></h3>
                </div>
                <div class="modal-body">
                    @include('layouts.theme')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-effect-ripple btn-primary updateTheme">更新配色</button>
                    <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">关闭</button>
                </div>

            </div>
        </div>
    </div>

    <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
        <!-- Alternative Sidebar -->
        <div id="sidebar-alt" tabindex="-1" aria-hidden="true">
            <!-- Toggle Alternative Sidebar Button (visible only in static layout) -->
            <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i
                        class="fa fa-times"></i></a>

            <!-- Wrapper for scrolling functionality -->
            @include('layouts.profile')
                    <!-- END Wrapper for scrolling functionality -->
        </div>
        <!-- END Alternative Sidebar -->

        <!-- Main Sidebar -->
        <div id="sidebar">
            @section('sidebar')
                    <!-- Sidebar Brand -->
            <div id="sidebar-brand" class="themed-background">
                <a href="/admin/system/index" class="sidebar-title">
                    <i class="fa fa-cube"></i> <span class="sidebar-nav-mini-hide">MyAdmin <strong>V1.0
                            Beta</strong></span>
                </a>
            </div>
            <!-- END Sidebar Brand -->

            <!-- Wrapper for scrolling functionality -->
            <div id="sidebar-scroll">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Sidebar Navigation -->
                    <ul class="sidebar-nav">
                        <li>
                            <a href="/{{Request::path()}}" @if(Request::path() == 'admin/system/index' || Request::path() == 'admin/system/index') class="active" @endif><i
                                        class="gi gi-compass sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">控制台</span></a>
                        </li>
                        <li class="sidebar-separator">
                            <i class="fa fa-ellipsis-h"></i>
                        </li>
                        @foreach($nodeData as $key=>$node)
                            <li>
                                <a href="#" class="sidebar-nav-menu @if($NodeCrumb['id'] == $node['Id']) open @endif"><i
                                            class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i
                                            class="fa {{ $node->Icon }} sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">{{$node->NodeName}}</span></a>
                                <ul>
                                    @foreach($node->children as $key=>$child)
                                        <li>
                                            <a href="/admin/{{$moduleName}}/{{$child->Href}}"
                                               @if($NodeCrumb['href'] == ltrim($child->Href,'/') && ($NodeCrumb['moduleId'] == $node['Module'])) class="active" @endif>{{$child->NodeName}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endforeach
                    </ul>
                    <!-- END Sidebar Navigation -->

                    <!-- Color Themes -->
                    <!-- Preview a theme on a page functionality can be found in js/app.js - colorThemePreview() -->

                    <!-- END Color Themes -->
                </div>
                <!-- END Sidebar Content -->
            </div>
            <!-- END Wrapper for scrolling functionality -->

            <!-- Sidebar Extra Info -->
            <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">

                <div class="text-center">
                    <small>MyAdmin With <i class="fa fa-heart text-danger"></i> By <a href="http://goo.gl/vNS3I"
                                                                                      target="_blank">CrazyCodes</a>
                    </small>
                    <br>
                    <small><span id="year-copy"></span> &copy; <a href="http://goo.gl/RcsdAh" target="_blank">MyAdmin
                        </a></small>
                </div>
            </div>
            <!-- END Sidebar Extra Info -->
            @show
        </div>
        <!-- END Main Sidebar -->

        <!-- Main Container -->
        <div id="main-container">
            <!-- Header -->
            <!-- In the PHP version you can set the following options from inc/config file -->
            <!--
                Available header.navbar classes:

                'navbar-default'            for the default light header
                'navbar-inverse'            for an alternative dark header

                'navbar-fixed-top'          for a top fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                    'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

                'navbar-fixed-bottom'       for a bottom fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                    'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
            -->
            <header class="navbar navbar-default navbar-fixed-top">
                <!-- Left Header Navigation -->
                <ul class="nav navbar-nav-custom">
                    <!-- Main Sidebar Toggle Button -->
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                            <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                            <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                        </a>

                    </li>
                    <li>
                        <a href="#modal-fade" data-toggle="modal">
                            <i class="fa fa-dropbox fa-fw"></i>
                        </a>

                    </li>
                    <!-- END Main Sidebar Toggle Button -->

                    <!-- Header Link -->

                    @foreach($moduleData as $key=>$value)
                        <li class="hidden-xs animation-fadeInQuick">
                            <a href="/admin/{{strtolower($value->ModuleName)}}/index">[&nbsp; <i
                                        class="{{$value->Icon}}"></i><strong>
                                    {{$value->Title}}
                                </strong> &nbsp;] </a>

                        </li>

                        @endforeach

                                <!-- END Header Link -->
                </ul>
                <!-- END Left Header Navigation -->

                <!-- Right Header Navigation -->
                <ul class="nav navbar-nav-custom pull-right">
                    <!-- Search Form -->

                    <!-- END Search Form -->

                    <!-- Alternative Sidebar Toggle Button -->
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');this.blur();">
                            <i class="gi gi-settings"></i>
                        </a>
                    </li>
                    <!-- END Alternative Sidebar Toggle Button -->

                    <!-- User Dropdown -->
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/asstes/img/placeholders/avatars/avatar9.jpg" alt="avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-header">
                                <strong>所属角色 : 超级管理员</strong>
                            </li>
                            <li>
                                <a href="page_app_social.html">
                                    <i class="fa fa-pencil-square fa-fw pull-right"></i>
                                    我的信息
                                </a>
                            </li>
                            <li>
                                <a href="page_app_media.html">
                                    <i class="fa fa-picture-o fa-fw pull-right"></i>
                                    媒体库
                                </a>
                            </li>
                            <li class="divider">
                            <li>
                            <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                                    <i class="gi gi-settings fa-fw pull-right"></i>
                                    设置
                                </a>
                            </li>
                            <li>
                                <a href="page_ready_lock_screen.html">
                                    <i class="gi gi-lock fa-fw pull-right"></i>
                                    锁定账户
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="logout">
                                    <i class="fa fa-power-off fa-fw pull-right"></i>
                                    注销
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END User Dropdown -->
                </ul>
                <!-- END Right Header Navigation -->
            </header>
            <!-- END Header -->

            <!-- Page content -->
            @section('content')
            @show
                    <!-- END Page Content -->
        </div>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
</div>
<!-- END Page Wrapper -->


<!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
<script src="/asstes/js/vendor/jquery-2.2.4.min.js"></script>
<script src="/asstes/js/vendor/bootstrap.min.js"></script>
<script src="/asstes/js/plugins.js"></script>
<script src="/asstes/js/app.js"></script>

<script src="/plugin/toast/src/jquery.toast.js"></script>
<script src="/core/readyLogout.js"></script>
<script src="/core/myData.js"></script>
<script src="/core/updateTheme.js"></script>

@section('scripts')

@show
</body>
</html>