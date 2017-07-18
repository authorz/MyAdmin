<script>
    <?php foreach (self::$topBtn as $key => $topBtn) { if($topBtn['value']){ ?>
    $('a[value="<?=$topBtn['value']?>"]').on('click', function () {

        <?php if($topBtn['type'] == 'url'){ ?>
            location.href = '<?=$topBtn['url']?>';
        <?php }else{ ?>

        var allChoose = "";

        $('input:checkbox[name="checkbox"]:checked').each(function (i) {
            if (0 == i) {
                allChoose = $(this).val();
            } else {
                allChoose += ("," + $(this).val());
            }
        });

        if(allChoose == ""){
            $.toast({
                heading: '提示',
                text: '请选择要操作的数据集',
                position: 'top-center',
                icon: 'error',
                hideAfter: 1000,
                afterHidden: function () {

                }
            });

            return false;
        }

        $.post("<?=$topBtn['url']?>",{'data':allChoose},function (event){
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
        <?php } ?>
    });
    <?php }} ?>
</script>