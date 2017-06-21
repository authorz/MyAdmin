<!DOCTYPE html>
<!--[if IE 9]>
<html class="no-js lt-ie10" lang="en">
<![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?= self::$title ?></title>
    <meta name="description" content="<?= self::$title ?>">
    <meta name="author" content="crazycodes">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <?php foreach (self::$config['css'] as $key => $value) { ?>
        <link rel='stylesheet' href='<?= $value ?>'/>
    <?php } ?>
</head>
<body>
<div id="page-wrapper" class="page-loading">
    <div class="preloader">
        <div class="inner">
            <div class="preloader-spinner themed-background hidden-lt-ie10"></div>
            <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
        </div>
    </div>
</div>
<div id="page-content">

    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1 style="font-size:20px;"><?= self::$topTitle ?></h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <?php foreach (self::$breadCrumbs as $key => $val) { ?>

                            <?php if ((count(self::$breadCrumbs) - 1) == $key) { ?>
                                <li><a href=""><?= $val ?></a></li>
                            <?php } else { ?>
                                <li><?= $val ?></li>
                            <?php } ?>

                        <?php } ?>


                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

            <div class="block">
                <div class="block-title">
                    <!--                    <div class="block-options pull-right">-->
                    <!--                        <a href="javascript:void(0)"-->
                    <!--                           class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip" data-toggle="button"-->
                    <!--                           title="简化"><i class="fa fa-bars"></i></a>-->
                    <!--                    </div>-->
                    <h2><?= self::$title ?></h2>
                </div>

                <form action="<?= self::$url ?>" method="<?= self::$way ?>" name="form"
                      class="form-horizontal form-bordered" id="form-validation"
                    <?php if (self::$isAjax) { ?> onsubmit="return false;" <?php } ?> enctype="multipart/form-data"
                      style="margin: 0px -11px 2px;">
                    <?php
                    foreach (self::$receive as $key => $item) {
                        switch ($item['type']) {
                            case 'hidden':
                                include BUILDER_DIR . '/widget/froms/hidden.php';
                                break;
                            case 'text':
                                include BUILDER_DIR . '/widget/froms/text.php';
                                break;
                            case 'password':
                                include BUILDER_DIR . '/widget/froms/password.php';
                                break;
                            case 'textarea':
                                include BUILDER_DIR . '/widget/froms/textarea.php';
                                break;
                            case 'radio':
                                include BUILDER_DIR . '/widget/froms/radio.php';
                                break;
                            case 'checkbox':
                                include BUILDER_DIR . '/widget/froms/checkbox.php';
                                break;
                            case 'select':
                                include BUILDER_DIR . '/widget/froms/select.php';
                                break;
                            // 颜色选择器
                            case 'color':
                                include BUILDER_DIR . '/widget/froms/color.php';
                                break;
                            // 日期选择器
                            case 'date':
                                include BUILDER_DIR . '/widget/froms/date.php';
                                break;
                            // 时间选择器
                            case 'time':
                                include BUILDER_DIR . '/widget/froms/time.php';
                                break;
                            // 标签
                            case 'tags':
                                include BUILDER_DIR . '/widget/froms/tags.php';
                                break;
                            // 上传插件
                            case 'upload':
                                include BUILDER_DIR . '/widget/froms/upload.php';
                                break;
                            // ck富文本
                            case 'ueditor':
                                include BUILDER_DIR . '/widget/froms/ueditor.php';
                                break;
                            default:
                                break;

                        }
                    }
                    ?>

                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-effect-ripple btn-primary">提交</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger" style="margin-left: 10px;">
                                重置
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<?php foreach (self::$config['js'] as $key => $value) {
    echo "<script src='{$value}'></script>\n\r";
} ?>

<script>
    $(function () {
        FormsComponents.init();

        <?php include BUILDER_DIR . "/widget/froms/script/upload.js.php"?>

        <?php include BUILDER_DIR . "/widget/froms/script/ueditor.js.php"?>

        <?php include BUILDER_DIR . "/widget/froms/script/form.js.php"?>
    });
</script>

</body>
</html>