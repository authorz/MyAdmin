$('form[name="form"]').submit(function () {


    console.log($(form).serializeArray());

    $.ajax({
        type: "<?= self::$way ?>",
        url: "<?= self::$url ?>",
        data: $(form).serializeArray(),
        success: function (event) {
            event = $.parseJSON(event);

            if (event['code'] == 200) {
                $.toast({
                    heading: '提示',
                    text: event['message'],
                    position: 'top-center',
                    icon: 'success',
                    hideAfter: 1000,
                    afterHidden: function () {
                        //location.href=location.href;
                    }
                });
            } else {
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
        }
    });
});