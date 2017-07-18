<div class="form-group">
    <label class="col-md-3 control-label"><?= $item['title'] ?></label>
    <div class="col-md-9">
        <?php foreach ($item['parameter'] as $key => $checkbox) { ?>
            <div class="checkbox">
                <label for="<?= $item['name'] ?>">
                    <input type="checkbox" <?php if (isset($item['id'])) { ?> id="<?= $item['id'] ?>" <?php } ?>
                           name="<?= $item['name'] ?>[]"
                           value="<?= $key ?>" class="<?= $item['append']['class'] ?>"
                           style="<?= $item['append']['style'] ?>" <?= $item['extra'] ?>> <?= $checkbox ?>
                </label>
            </div>
        <?php } ?>
        <?php if (isset($item['help'])) { ?>
            <span class="help-block"><?= $item['help'] ?></span>
        <?php } ?>
    </div>
</div>

<?php unset($checkboxData); ?>
