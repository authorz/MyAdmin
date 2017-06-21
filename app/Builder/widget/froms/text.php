<?php if ($item['type'] == 'text') { ?>
    <div class="form-group">
        <label class="col-md-3 control-label" for="<?= $item['name'] ?>"><?= $item['title'] ?></label>
        <div class="col-md-9">
            <input type="<?= $item['type'] ?>" placeholder='<?= $item['placeholder'] ?>'
                <?php if (isset($item['id'])) { ?> id="<?= $item['id'] ?>" <?php } ?>
                   name="<?= $item['name'] ?>" value='<?= $item['value'] ?>'
                   class="form-control <?= $item['append']['class'] ?>"
                   style="<?= $item['append']['style'] ?>" <?= $item['extra'] ?>>
            <?php if (isset($item['help'])) { ?>
                <span class="help-block"><?= $item['help'] ?></span>
            <?php } ?>
        </div>
    </div>
<?php } ?>
