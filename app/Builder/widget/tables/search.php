<?php
if (self::$isSearch == TRUE) {
    ?>
    <div class="block full"
         style="<?php if (isset($_GET['page']) && count($_GET) > 1) { ?>display: block<?php } else { ?>display:none<?php } ?>"
         id="search">
        <form action="" method="get" class="form-inline" style="text-align: right">
            <input type="hidden" value="<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>" name="page">
            <?php foreach (self::$fromData as $key => $formData) { ?>
                <div class="form-group">
                    <label class="sr-only" for="<?= $formData['value'] ?>"><?= $formData['name'] ?></label>
                    <input type="text" value="<?= $_GET[$formData['value']] ?>" id="<?= $formData['value'] ?>"
                           name="<?= $formData['value'] ?>"
                           class="form-control"
                           placeholder="<?= $formData['name'] ?>">
                </div>
            <?php } ?>
            <div class="form-group">
                <button type="submit" class="btn btn-effect-ripple btn-primary"
                        style="overflow: hidden; position: relative;">搜索
                </button>
            </div
        </form>
    </div>
<?php } ?>