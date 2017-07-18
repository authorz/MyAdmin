<script>
    var FormsValidation = function () {

        return {
            init: function () {

                $('#form-validation').validate({
                    errorClass: 'help-block animation-pullUp',
                    errorElement: 'div',
                    errorPlacement: function (error, e) {
                        e.parents('.form-group > div').append(error);
                    },
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                        $(e).closest('.help-block').remove();
                    },
                    success: function (e) {
                        e.closest('.form-group').removeClass('has-success has-error');
                        e.closest('.help-block').remove();
                    },
                    submitHandler: function (form) {
                        <?php if (!self::$isAjax) { ?>
                        form.submit()
                        <?php }else{ ?>
                        console.log($(form).serializeArray());
                        $.ajax({
                            type: "<?= self::$way ?>",
                            url: "<?= self::$url ?>",
                            data: $(form).serializeArray(),
                            success: function (event) {
                                console.log(event);
                            }
                        });

                        <?php } ?>

                    },
//                    rules: {
//                        <?php //foreach(self::$receive as $key=>$val){ ?>
//                        '<?//= $val['name'] ?>//': {
//                            required: true
//                        },
//                        <?php //} ?>
//                    },
//                    messages: {
//                        <?php //foreach(self::$receive as $key=>$val){ ?>
//                        '<?//= $val['name'] ?>//': {
//                            required: 'Please enter a username'
//                        },
//                        <?php //} ?>
//
//                    }
                });
            }
        };
    }();

    FormsValidation.init();
</script>