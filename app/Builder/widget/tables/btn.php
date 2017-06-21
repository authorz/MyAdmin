<td>
    <?php foreach (self::$rightBtn as $key => $rightBtn) { ?>
        <a href="javascript:;"
           value="<?= $rightBtn['value'] ?>_right" <?php foreach ($rightBtn['custom'] as $key => $custom) { ?><?=$custom?>='<?=$item[$custom]?>'<?php } ?>
           class="btn btn-effect-ripple btn-sm btn-danger"><?= $rightBtn['name'] ?></a>
    <?php } ?>
</td>