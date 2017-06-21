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
                    <div class="widget-content widget-content-mini text-right clearfix">
                        <div class="widget-icon pull-left themed-background">
                            <i class="gi gi-cardio text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3">
                            <strong><span data-toggle="counter" data-to="2835"></span></strong>
                        </h2>
                        <span class="text-muted">SALES</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini text-right clearfix">
                        <div class="widget-icon pull-left themed-background-success">
                            <i class="gi gi-user text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-success">
                            <strong>+ <span data-toggle="counter" data-to="2862"></span></strong>
                        </h2>
                        <span class="text-muted">NEW USERS</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini text-right clearfix">
                        <div class="widget-icon pull-left themed-background-warning">
                            <i class="gi gi-briefcase text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-warning">
                            <strong>+ <span data-toggle="counter" data-to="75"></span></strong>
                        </h2>
                        <span class="text-muted">PROJECTS</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget">
                    <div class="widget-content widget-content-mini text-right clearfix">
                        <div class="widget-icon pull-left themed-background-danger">
                            <i class="gi gi-wallet text-light-op"></i>
                        </div>
                        <h2 class="widget-heading h3 text-danger">
                            <strong>$ <span data-toggle="counter" data-to="5820"></span></strong>
                        </h2>
                        <span class="text-muted">EARNINGS</span>
                    </div>
                </a>
            </div>
            <!-- END Simple Stats Widgets -->
        </div>
        <!-- END First Row -->

        <!-- Second Row -->
        <div class="row">
            <div class="col-sm-6 col-lg-8">
                <!-- Chart Widget -->
                <div class="widget">
                    <div class="widget-content border-bottom">
                        <span class="pull-right text-muted">2013</span>
                        Last Year's Data
                    </div>
                    <div class="widget-content border-bottom themed-background-muted">
                        <!-- Flot Charts (initialized in js/pages/readyDashboard.js), for more examples you can check out http://www.flotcharts.org/ -->
                        <div id="chart-classic-dash" style="height: 393px;"></div>
                    </div>
                    <div class="widget-content widget-content-full">
                        <div class="row text-center">
                            <div class="col-xs-4 push-inner-top-bottom border-right">
                                <h3 class="widget-heading"><i class="gi gi-wallet text-dark push-bit"></i> <br>
                                    <small>$ 41k</small>
                                </h3>
                            </div>
                            <div class="col-xs-4 push-inner-top-bottom">
                                <h3 class="widget-heading"><i class="gi gi-cardio text-dark push-bit"></i> <br>
                                    <small>17k Sales</small>
                                </h3>
                            </div>
                            <div class="col-xs-4 push-inner-top-bottom border-left">
                                <h3 class="widget-heading"><i
                                            class="gi gi-life_preserver text-dark push-bit"></i> <br>
                                    <small>3k+ Tickets</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Chart Widget -->
            </div>
            <div class="col-sm-6 col-lg-4">
                <!-- Stats User Widget -->
                <a href="page_ready_profile.html" class="widget">
                    <div class="widget-content border-bottom text-dark">
                        <span class="pull-right text-muted">This week</span>
                        Featured Author
                    </div>
                    <div class="widget-content border-bottom text-center themed-background-muted">
                        <img src="/asstes/img/placeholders/avatars/avatar13@2x.jpg" alt="avatar"
                             class="img-circle img-thumbnail img-thumbnail-avatar-2x">
                        <h2 class="widget-heading h3 text-dark">Anna Wigren</h2>
                                        <span class="text-muted">
                                            <strong>Logo Designer</strong>, Sweden
                                        </span>
                    </div>
                    <div class="widget-content widget-content-full-top-bottom">
                        <div class="row text-center">
                            <div class="col-xs-6 push-inner-top-bottom border-right">
                                <h3 class="widget-heading"><i class="gi gi-briefcase text-dark push-bit"></i>
                                    <br>
                                    <small>35 Projects</small>
                                </h3>
                            </div>
                            <div class="col-xs-6 push-inner-top-bottom">
                                <h3 class="widget-heading"><i class="gi gi-heart_empty text-dark push-bit"></i>
                                    <br>
                                    <small>5.3k Likes</small>
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
                                <strong>98k</strong><br>Followers
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
                                Active Servers
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