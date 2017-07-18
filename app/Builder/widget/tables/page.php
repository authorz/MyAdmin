<?php if (self::$limit > 0) { ?>
    <div class="text-right">
        <ul class="pagination pagination-sm">
            <li><a href="<?= $this->prevPage(); ?>"><i class="fa fa-chevron-left"></i></a>
            </li>
            <?php for ($i = 1; $i <= self::$limit; $i++) { ?>
                <?php if ($_GET['page'] == $i) { ?>
                    <li class="active"><a href="javascript:void(0)"><?= $i ?></a></li>
                <?php } elseif (empty($_GET['page']) && $i == 1) { ?>
                    <li class="active"><a href="javascript:void(0)"><?= $i ?></a></li>
                <?php } else { ?>
                    <li><a href="?page=<?= $i ?><?= $this->queryString() ?>"><?= $i ?></a></li>
                <?php } ?>
            <?php } ?>
            <li>
                <a href="<?= $this->nextPage() ?>"><i
                        class="fa fa-chevron-right"></i></a></li>
        </ul>
    </div>
<?php } ?>