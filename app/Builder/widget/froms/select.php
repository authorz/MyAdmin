<?php if ($item['type'] == 'select') { ?>
    <div class="form-group">
        <label class="col-md-3 control-label" for="<?= $item['name'] ?>"><?= $item['title'] ?></label>
        <div class="col-md-5">
            <select <?php if (isset($item['id'])) { ?> id="<?= $item['id'] ?>" <?php } ?>
                name="<?= $item['name'] ?>"
                class="select-chosen <?= $item['append']['class'] ?>"
                data-placeholder="<?= $item['placeholder'] ?>"
                style="<?= $item['append']['style'] ?>" <?= $item['extra'] ?>>;
                <option></option>
                <?php foreach ($item['parameter'] as $key => $select) { ?>
                    <option value="<?= $key ?>"><?= $select ?></option>
                <?php } ?>
            </select>
            <?php if (isset($item['help'])) { ?>
                <span class="help-block"><?= $item['help'] ?></span>
            <?php } ?>
        </div>
    </div>
<?php } ?>
