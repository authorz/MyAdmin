/*
 *  Document   : readyLogin.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Login page
 */

var ReadyLogin = function () {

    return {
        init: function () {
            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

            /* Login form - Initialize Validation */
            $('#form-login').validate({
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
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
                rules: {
                    'login-username': {
                        required: true,
                        minlength: 5
                    },
                    'login-password': {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    'login-username': {
                        required: '请填写登录用户名',
                        minlength: '密码必须至少5个字符'
                    },
                    'login-password': {
                        required: '请填写登录密码',
                        minlength: '密码必须至少5个字符'
                    }
                },
                submitHandler: function (form) {

                    var formdata = $('#form-login').serialize();

                    $.ajax({
                        url: 'auth/login',
                        data: formdata,
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
                                        location.href = '/admin/index';
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
                }
            });
        }
    };
}();