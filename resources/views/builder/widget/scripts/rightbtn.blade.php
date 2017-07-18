<script>
    @foreach($rightBtn as $key=>$rbth)
    $('a[value="{{$rbth['value']}}_right"]').on('click', function () {
        @if($rbth['type'])
        $.ajax({
            type: "{{$rbth['way']}}",
            url: "{{$rbth['url']}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                @foreach($rbth['custom'] as $key=>$item)
                '{{$item}}': $(this).attr('{{$item}}'),
                @endforeach
            },
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
                            location.href = location.href;
                        }
                    });
                }
            }
        });
                @else
        var url = '';
        @foreach($rbth['custom'] as $key=>$item)
                @if((count($rbth['custom']) - 1) == $key)
                url += '{{$item}}=' + $(this).attr('{{$item}}');

        @else
                url += '{{$item}}=' + $(this).attr('{{$item}}') + "&";

        @endif

                @endforeach

                location.href = '{{$rbth['url']}}?' + url;
        @endif
    });

    @endforeach
</script>