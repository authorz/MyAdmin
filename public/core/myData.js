/**
 * Created by crazy on 2017/5/24.
 */
$.ajax({
    url: '/admin/getEmail',
    type: 'GET',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (res) {
        $('#side-profile-email').val(res.return.Email);
    }
});

$('#myData').submit(function () {

    var formData = $(this).serializeArray();

    $.ajax({
        url: '/admin/modifyEmail',
        data: formData,
        type: 'POST',
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
                        App.sidebar('close-sidebar-alt');
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

$('#myPass').submit(function () {

    var formData = $(this).serializeArray();

    $.ajax({
        url: '/admin/modifyPass',
        data: formData,
        type: 'POST',
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
                        App.sidebar('close-sidebar-alt');
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