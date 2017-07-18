<script>
    <?php foreach (self::$rightBtn as $key => $rightBtn) { ?>

    $('a[value="<?=$rightBtn['value']?>_right"]').on('click', function () {
        <?php if($rightBtn['type']){ ?>
        $.<?=$rightBtn['way']?>('<?=$rightBtn['url']?>', {
            <?php foreach($rightBtn['custom'] as $key=>$item){ ?>
            '<?=$item?>': $(this).attr('<?=$item?>'),
            <?php } ?>
            }, function (event) {
                event = $.parseJSON(event);

                if(event['code'] == 200){
                $.toast({
                    heading: '提示',
                    text: event['message'],
                    position: 'top-center',
                    icon: 'success',
                    hideAfter: 1000,
                    afterHidden: function () {
                        location.href=location.href;
                        }
                    });
                }else{
                    $.toast({
                        heading: '提示',
                        text: event['message'],
                        position: 'top-center',
                        icon: 'error',
                        hideAfter: 1000,
                        afterHidden: function () {
                            //location.href=location.href;
                            }
                    });
                }
            });
        <?php }else{ ?>
        var url = '';
        <?php foreach($rightBtn['custom'] as $key=>$item){ ?>
        <?php if((count($rightBtn['custom']) - 1) == $key){ ?>
        url += '<?=$item?>=' + $(this).attr('<?=$item?>');
        <?php }else{ ?>
        url += '<?=$item?>=' + $(this).attr('<?=$item?>') + "&";
        <?php } ?>
        <?php } ?>
        location.href = '<?=$rightBtn['url']?>?' + url;

        <?php } ?>

    });

    <?php } ?>
</script>