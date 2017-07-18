<?php foreach (self::$receive as $key => $item) { ?>
<?php if ($item['type'] == 'ueditor') { ?>
UE.getEditor('<?= $item['name'] ?>');
<?php } ?>
<?php } ?>