@extends('layouts.app')

@section('title','MyAdmin - 后台首页')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div id="page-content">
        <!-- First Row -->
        <div class="row">
            <!-- Simple Stats Widgets -->
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini themed-background-dark-social">
                        <span class="pull-right text-muted"></span>
                        <strong class="text-light-op">管理员</strong>
                    </div>
                    <div class="widget-content themed-background-social clearfix">
                        <div class="widget-icon pull-right">
                            <i class="gi gi-airplane text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-light"><strong>10</strong></h2>
                        <span class="text-light-op">管理员总数</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini themed-background-dark-flat">
                        <span class="pull-right text-muted"></span>
                        <strong class="text-light-op">节点</strong>
                    </div>
                    <div class="widget-content themed-background-flat clearfix">
                        <div class="widget-icon pull-right">
                            <i class="gi gi-albums text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-light"><strong>5</strong></h2>
                        <span class="text-light-op">节点总数</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini themed-background-dark-creme">
                        <span class="pull-right text-muted"></span>
                        <strong class="text-light-op">角色</strong>
                    </div>
                    <div class="widget-content themed-background-creme clearfix">
                        <div class="widget-icon pull-right">
                            <i class="gi gi-wifi text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-light"><strong>15</strong></h2>
                        <span class="text-light-op">角色总数</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini themed-background-dark-amethyst">
                        <span class="pull-right text-muted"></span>
                        <strong class="text-light-op">模块</strong>
                    </div>
                    <div class="widget-content themed-background-amethyst clearfix">
                        <div class="widget-icon pull-right">
                            <i class="gi gi-video_hd text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-light"><strong>25</strong></h2>
                        <span class="text-light-op">模块总数</span>
                    </div>
                </a>
            </div>

            <!-- END Simple Stats Widgets -->
        </div>
        <!-- END First Row -->

        <!-- Second Row -->
        <div class="row">
            <div class="col-sm-6 col-lg-9">
                <!-- Chart Widget -->
                <div class="widget">
                    <div class="widget-content border-bottom">
                        <span class="pull-right text-muted">2017</span>
                        栏目数据信息
                    </div>
                    <div class="widget-content border-bottom themed-background-muted">
                        <!-- Flot Charts (initialized in js/pages/readyDashboard.js), for more examples you can check out http://www.flotcharts.org/ -->
                        <div id="chart-classic-dash" style="height: 393px;"></div>
                    </div>
                    <div class="widget-content widget-content-full">
                        <div class="row text-center">
                            <div class="col-xs-4 push-inner-top-bottom border-right">
                                <h3 class="widget-heading"><i class="gi gi-wallet text-dark push-bit"></i> <br>
                                    <small>列表总数:41</small>
                                </h3>
                            </div>
                            <div class="col-xs-4 push-inner-top-bottom">
                                <h3 class="widget-heading"><i class="gi gi-cardio text-dark push-bit"></i> <br>
                                    <small>图片总数:34</small>
                                </h3>
                            </div>
                            <div class="col-xs-4 push-inner-top-bottom border-left">
                                <h3 class="widget-heading"><i
                                            class="gi gi-life_preserver text-dark push-bit"></i> <br>
                                    <small>软件总数:56</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Chart Widget -->
            </div>
            <div class="col-sm-6 col-lg-3">
                <!-- Stats User Widget -->
                <a href="page_ready_profile.html" class="widget">
                    <div class="widget-content border-bottom text-dark">
                        <span class="pull-right text-muted"></span>
                        个人信息
                    </div>
                    <div class="widget-content border-bottom text-center themed-background-muted">
                        <img src="/asstes/img/placeholders/avatars/avatar13@2x.jpg" alt="avatar"
                             class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                        <h2 class="widget-heading h3 text-dark">Admin</h2>
                                        <span class="text-muted">
                                            <strong>首席执行官</strong>
                                        </span>
                    </div>
                    <div class="widget-content widget-content-full-top-bottom">
                        <div class="row text-center">
                            <div class="col-xs-6 push-inner-top-bottom border-right">
                                <h3 class="widget-heading"><i class="gi gi-briefcase text-dark push-bit"></i>
                                    <br>
                                    <small>查看权限</small>
                                </h3>
                            </div>
                            <div class="col-xs-6 push-inner-top-bottom">
                                <h3 class="widget-heading"><i class="gi gi-heart_empty text-dark push-bit"></i>
                                    <br>
                                    <small>个人信息</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- END Stats User Widget -->

                <!-- Mini Widgets Row -->
                <div class="row">
                    <div class="col-xs-6">
                        <a href="javascript:void(0)" class="widget">
                            <div class="widget-content themed-background-info text-light-op text-center">
                                <div class="widget-icon">
                                    <i class="fa fa-facebook"></i>
                                </div>
                            </div>
                            <div class="widget-content text-dark text-center">
                                <strong>98</strong><br>字段
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="javascript:void(0)" class="widget">
                            <div class="widget-content themed-background-danger text-light-op text-center">
                                <div class="widget-icon">
                                    <i class="fa fa-database"></i>
                                </div>
                            </div>
                            <div class="widget-content text-dark text-center">
                                <strong>15</strong><br>
                                数据库
                            </div>
                        </a>
                    </div>
                </div>
                <!-- END Mini Widgets Row -->
            </div>
        </div>
        <!-- END Second Row -->

        <!-- Third Row -->
        
        <!-- END Third Row -->
    </div>
@endsection
@section('scripts')
    <script src="/asstes/js/pages/readyDashboard.js"></script>
    <script>$(function(){ ReadyDashboard.init(); });</script>
@endsection