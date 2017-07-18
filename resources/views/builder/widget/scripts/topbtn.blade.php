<script>
    @foreach($topBtn as $key=>$tb)
    @if($tb['value'])
    $('a[value="{{$tb['value']}}"]').on('click', function () {

        @if($tb['type'] == 'url')
                location.href = '{{$tb['url']}}';
                @else
        var allChoose = "";

        $('input:checkbox[name="checkbox"]:checked').each(function (i) {
            if (0 == i) {
                allChoose = $(this).val();
            } else {
                allChoose += ("," + $(this).val());
            }
        });

        if (allChoose == "") {
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


        $.ajax({
            type: "post",
            url: "{{$tb['url']}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'{{$listKey}}': allChoose},
            success: function (event) {
                if (event['code'] == 200) {
                    $.toast({
                        heading: '提示',
                        text: event['message'],
                        position: 'top-center',
                        icon: 'success',
                        hideAfter: 1000,
                        afterHidden: function () {
                            location.href = location.href;
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
                            //location.href = location.href;
                        }
                    });
                }
            }
        });
        @endif
    });
    @endif
    @endforeach
</script>