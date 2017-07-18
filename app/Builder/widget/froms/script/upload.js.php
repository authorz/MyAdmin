<?php foreach (self::$receive as $key => $item) { ?>
<?php if ($item['type'] == 'upload') { ?>
$("#<?=$item['name']?>").fileinput({
    language: 'zh',
    theme: 'explorer',
    uploadUrl: '<?=self::$uploadConfig['upload_url'] ?>',
    dropZoneEnabled: true,
    overwriteInitial: false,
    initialPreviewAsData: true,
    deleteUrl: '<?=self::$uploadConfig['delete_url'] ?>',
    initialPreview: [
        <?php foreach($item['parameter'] as $key=>$upload){ ?>
        "<?=$upload['url']?>",
        <?php } ?>
    ],
    initialPreviewConfig: [
        <?php foreach($item['parameter'] as $key=>$upload){ ?>
        {caption: "<?=$upload['caption']?>", size: <?=$upload['size']?>, width: "120px", key: <?=$upload['key']?>},
        <?php } ?>
    ]
});


// 删除成功上传的缩略图后触发事件
$('#<?=$item['name']?>').on('filesuccessremove', function (event, id) {
    if (id) {
        console.log(id);
    } else {
        return false; // abort the thumbnail removal
    }
});

// 排序获取方法
$('#<?=$item['name']?>').on('filesorted', function (event, params) {
    console.log('File sorted ', params.previewId, params.oldIndex, params.newIndex, params.stack);
});

// 触发上传后
$('#<?=$item['name']?>').on('fileuploaded', function (event, data, previewId, index) {
    var form = data.form, files = data.files, extra = data.extra,
        response = data.response, reader = data.reader;

    $('form').append('<input type="hidden" value="' + response['key'] + '" name="<?=$item['name']?>[]">');
    console.log(response['key']);


});
<?php } ?>
<?php } ?>