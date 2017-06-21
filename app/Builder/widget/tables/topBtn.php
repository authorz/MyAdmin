<?php foreach (self::$topBtn as $key => $item) { ?>
    <a href="javascript:;" value="<?= $item['value'] ?>"
       class="btn btn-effect-ripple btn-primary"><?= $item['name'] ?></a>
<?php } ?>