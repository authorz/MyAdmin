<script>
    $('form[name="form"]').submit(function () {
        $.ajax({
            type: "{{$way}}",
            url: "{{$url}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $(form).serializeArray(),
            success: function (event) {

                if (event['code'] == 200) {
                    $.toast({
                        heading: '提示',
                        text: event['message'],
                        position: 'top-center',
                        icon: 'success',
                        hideAfter: 1000,
                        afterHidden: function () {
                            var redirect = $('input[name="redirect"]').val();

                            if (redirect) {
                                location.href = redirect;
                            } else {
                                location.href = location.href;
                            }

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
            },
            error: function (event) {

                if (event['status'] == 422) {
                    var content = '';

                    for (var item in event['responseJSON']) {
                        content += event['responseJSON'][item] + '<br/>';
                    }
                    console.log(content);
                    $.toast({
                        heading: '提示',
                        text: content,
                        position: 'top-center',
                        icon: 'error',
                        hideAfter: 1000,
                    });
                }

            }
        });
    });
</script>