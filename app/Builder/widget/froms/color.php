<?php if ($item['type'] == 'color') { ?>
    <div class="form-group">
        <label class="col-md-3 control-label" for="<?= $item['name'] ?>"><?= $item['title'] ?></label>
        <div class="col-md-5">
            <div class="input-group input-colorpicker">
                <input type="text" <?php if (isset($item['id'])) { ?> id="<?= $item['id'] ?>" <?php } ?>
                       name="<?= $item['name'] ?>" class="form-control <?= $item['append']['class'] ?>"
                       value="<?= isset($item['value']) ? $item['value'] : '#000' ?>"
                       style="<?= $item['append']['style'] ?>" <?= $item['extra'] ?>>
                <span class="input-group-addon"><i></i></span>
            </div>
            <?php if (isset($item['help'])) { ?>
                <span class="help-block"><?= $item['help'] ?></span>
            <?php } ?>
        </div>
    </div>
<?php } ?>