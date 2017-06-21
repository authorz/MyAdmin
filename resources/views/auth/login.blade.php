<!DOCTYPE html>
<!--[if IE 9]>
<html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>后台管理登陆 - MyAdmin</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/asstes/css/bootstrap.min.css">
    <link rel="stylesheet" href="/asstes/css/plugins.css">
    <link rel="stylesheet" href="/asstes/css/main.css">
    <link rel="stylesheet" href="/asstes/css/themes.css">
    <script src="/asstes/js/vendor/modernizr-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/plugin/toast/src/jquery.toast.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<img src="/asstes/img/placeholders/layout/login2_full_bg.jpg" alt="Full Background" class="full-bg animation-pulseSlow">
<div id="login-container">
    <h1 class="h2 text-light text-center push-top-bottom animation-pullDown">
        <i class="fa fa-cube text-light-op"></i> <strong>MyAdmin</strong>
    </h1>
    <div class="block animation-fadeInQuick">
        <div class="block-title">
            <h2>请登录</h2>
        </div>
        <form id="form-login" action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="login-username" class="col-xs-12">用户名</label>
                <div class="col-xs-12">
                    <input type="text" id="login-username" name="login-username" class="form-control"
                           placeholder="请输入账号..." value="{{ $loginUserName }}">
                </div>
            </div>
            <div class="form-group">
                <label for="login-password" class="col-xs-12">密码</label>
                <div class="col-xs-12">
                    <input type="password" id="login-password" name="login-password" class="form-control"
                           placeholder="请输入密码..." value="{{ $loginPassWord }}">
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-8">
                    <label class="csscheckbox csscheckbox-primary">
                        <input type="checkbox" id="login-remember-me" name="login-remember-me" value="1"
                               @if($loginRemember == 1) checked @endif><span></span>
                        记住我
                    </label>
                </div>
                <div class="col-xs-4 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-sm btn-success">登 录</button>
                </div>
            </div>
        </form>
        <!-- END Login Form -->

        <!-- Social Login -->
        <!-- <hr>
        <div class="push text-center">其他登陆方式</div>
        <div class="row push">
            <div class="col-xs-6">
                <a href="javascript:void(0)" class="btn btn-effect-ripple btn-sm btn-info btn-block"><i
                            class="fa fa-facebook"></i> 微 信</a>
            </div>
            <div class="col-xs-6">
                <a href="javascript:void(0)" class="btn btn-effect-ripple btn-sm btn-primary btn-block"><i
                            class="fa fa-twitter"></i> Q Q</a>
            </div>
        </div>-->
        <!-- END Social Login -->
    </div>
    <!-- END Login Block -->

    <footer class="text-muted text-center animation-pullUp">
        <small><a href="http://blog.fastrun.cn" target="_blank">CrazyCodes</a> <span id="year-copy"></span> &copy; <a
                    href="http://goo.gl/RcsdAh" target="_blank">MyAdmin 1.0</a>
        </small>
    </footer>
</div>
<script src="/asstes/js/vendor/jquery-2.2.4.min.js"></script>
<script src="/asstes/js/vendor/bootstrap.min.js"></script>
<script src="/asstes/js/plugins.js"></script>
<script src="/asstes/js/app.js"></script>
<script src="/plugin/toast/src/jquery.toast.js"></script>
<script src="/core/readyLogin.js"></script>
<script>$(function () {
        ReadyLogin.init();
    });</script>
</body>
</html>