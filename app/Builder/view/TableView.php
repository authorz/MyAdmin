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

<?php include BUILDER_DIR . '/widget/tables/loading.php' ?>

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

    <?php include BUILDER_DIR . '/widget/tables/search.php' ?>

    <div class="block">
        <div class="block-title clearfix">
            <div class="block-options pull-left">
                <?php include BUILDER_DIR . '/widget/tables/topBtn.php' ?>
            </div>

            <div class="block-options pull-right">
                <div id="style-borders" class="btn-group">
                    <?php if (self::$isSearch) { ?>
                        <a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary" id="openSearch">搜索</a>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table id="general-table"
                   class="table table-vcenter table-borderless table-striped table-condensed table-hover">
                <thead>
                <tr>
                    <th style="width: 80px;" class="text-center"><label id="allChoose"
                                                                        class="csscheckbox csscheckbox-primary"><input
                                type="checkbox"><span></span></label></th>
                    <?php foreach (self::$column as $key => $item) { ?>
                        <th><?= $item['name'] ?></th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>

                <?php foreach (self::$listData as $key => $item) { ?>
                    <tr>
                        <td class="text-center">
                            <label class="csscheckbox csscheckbox-primary">
                                <input name="checkbox" type="checkbox"
                                       value="<?= $item[self::$listKey] ?>">
                                <span></span>
                            </label>
                        </td>
                        <?php foreach (self::$column as $key => $column) { ?>
                            <?php switch ($column['type']) {
                                case 'default':
                                    include BUILDER_DIR . "/widget/tables/default.php";
                                    break;
                                case 'btn':
                                    include BUILDER_DIR . "/widget/tables/btn.php";
                                    break;
                                case 'date':
                                    include BUILDER_DIR . "/widget/tables/date.php";
                                    break;
                                case 'url':
                                    include BUILDER_DIR . "/widget/tables/url.php";
                                    break;
                                case 'state':
                                    include BUILDER_DIR . "/widget/tables/state.php";
                                    break;
                                default:
                                    include BUILDER_DIR . "/widget/tables/default.php";
                                    break;
                            }
                            ?>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php include BUILDER_DIR . '/widget/tables/page.php'; ?>
    </div>

</div>
<?php foreach (self::$config['js'] as $key => $value) {
    echo "<script src='{$value}'></script>\n\r";
} ?>


<?php include BUILDER_DIR . '/widget/tables/script/rightBtn.js.php'; ?>
<?php include BUILDER_DIR . '/widget/tables/script/topBtn.js.php'; ?>

<script>
    $(function () {
        FormsComponents.init();
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
</body>
</html>