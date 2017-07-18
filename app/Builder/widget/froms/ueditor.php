<?php if ($item['type'] == 'ueditor') { ?>
    <div class="form-group">
        <label class="col-md-3 control-label" for="<?= $item['name'] ?>"><?= $item['title'] ?></label>
        <div class="col-md-9">
            <script id="<?= $item['name'] ?>" type="text/plain" name="<?= $item['name'] ?>" style="<?= $item['append']['style'] ?>" <?= $item['extra'] ?>><?= $item['value'] ?></script>
            <?php if (isset($item['help'])) { ?>
                <span class="help-block"><?= $item['help'] ?></span>
            <?php } ?>
        </div>
    </div>
<?php } ?>