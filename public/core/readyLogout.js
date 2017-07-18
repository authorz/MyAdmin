$('.logout').on('click', function () {
    $.ajax({
        url: '/logout',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {

            if (res.code == 0) {
                $.toast({
                    heading: '提示',
                    text: res.message,
                    position: 'top-center',
                    icon: 'error',
                    hideAfter: 1000
                });
            } else {
                $.toast({
                    heading: '提示',
                    text: res.message,
                    position: 'top-center',
                    icon: 'success',
                    hideAfter: 1000,
                    afterHidden: function () {
                        location.href = '/';
                    }
                });
            }

        },
        error: function (XMLHttpRequest, textStatus) {
            $.toast({
                heading: '提示',
                text: '系统错误 状态 : ' + textStatus + ' 状态码 : ' + XMLHttpRequest['status'],
                position: 'top-center',
                icon: 'error',
                hideAfter: 1000
            });
        }
    });
});