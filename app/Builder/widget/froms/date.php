<?php if ($item['type'] == 'date') { ?>
    <div class="form-group">
        <label class="col-md-3 control-label" for="<?= $item['name'] ?>"><?= $item['title'] ?></label>
        <div class="col-md-5">
            <input type="text" <?php if (isset($item['id'])) { ?> id="<?= $item['id'] ?>" <?php } ?>
                   name="<?= $item['name'] ?>" class="form-control input-datepicker <?= $item['append']['class'] ?>"
                   data-date-format="yyyy-mm-dd" placeholder="<?= $item['placeholder'] ?>"
                   style="<?= $item['append']['style'] ?>" <?= $item['extra'] ?> value='<?= $item['value'] ?>'>
            <?php if (isset($item['help'])) { ?>
                <span class="help-block"><?= $item['help'] ?></span>
            <?php } ?>
        </div>
    </div>
<?php } ?>