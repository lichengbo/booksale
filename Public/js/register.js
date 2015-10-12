$(document).ready(function() {
    // 表单验证
    var emailIsTrue = false;
    var passwordIsTrue = false;
    var codeCharIsTrue = false;

    // 邮箱验证正则表达式
    var emailPattern =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var passwordPattern = /^([a-z]|[A-Z]|[0-9]){6,16}$/;

    function checkEmail() {
        if(!emailPattern.test($('#email').val())) {
            $('#email').next().show();
            emailIsTrue = false;
        } else {
            emailIsTrue = true;
        }
    }

    //  验证密码格式函数
    function checkPassword() {
        var len = $(this).val().length;
        if(len < 6) {
            $(this).next().show();
            passwordIsTrue = false;
        } else if (len > 16) {
            $(this).next().show();
            $(this).next().text('密码过长应小于或等于16');
            passwordIsTrue = false;
        } else {
            if(!passwordPattern.test($(this).val())) {
                $(this).next().show();
                $(this).next().text('密码格式不正确，应由数字和字母组成');
                passwordIsTrue = false;
            } else {
                passwordIsTrue = true;
            }
        }
    }

    function checkPassword2() {
        if($(this).val() != $('#password1').val()) {
            $(this).next().show();
            $(this).next().text('两次密码不一致');
            passwordIsTrue = false;
        } else {
            passwordIsTrue = true;
        }
    }

    // 验证码验证函数
    function checkCodechar() {
        $.post("index.php?c=index&a=checkyzm", {value:$('#yzm').val()}, function(value){
            if(value.status) {
                codeCharIsTrue = true;
            } else {
                $('#yzm').next().css('display', 'block');
                codeCharIsTrue = false;
            }
        })
    }

    // 重新输入时恢复样式
    function Focus() {
        $(this).next().css('display','none');
    }

    $('#email').blur(checkEmail);
    $('#email').focus(Focus);
    $('#password1').focus(Focus);
    $('#password2').focus(Focus);
    $('#password1').blur(checkPassword);
    $('#password2').blur(checkPassword2);
    $('#yzm').blur(checkCodechar);
    $('#yzm').focus(Focus)
    $('#password1').focus(function() {
        $('#passwordErrorInfo2').hide();
    })

    $("#yzm-img").click(function(){
        $(this).attr("src",'public/php/code_char.php?' + Math.random());
        $("#yzm").focus();
    });

    $('#register').click(function() {
        var username = $('#username').val();
        var password = $('#password1').val();
        var password2 = $('#password2').val();
        var email = $('#email').val();
        var isagree = $('#isagree').prop('checked');

        if (username && passwordIsTrue && emailIsTrue && codeCharIsTrue && isagree) {
            $.ajax({
                type: "POST",
                url: "index.php?c=index&a=register_data",
                data: {username: username, password: password, email: email},
                dataType: 'json',
                success: function(value) {
                    if(value.status) {
                        alert('注册成功，请到登录页面登录');
                        location.href = "index.php?c=index&a=login";
                    } else {
                        alert('注册失败！' + value['errorInfo']);
                    }
                },
                error: function() {

                }
            });
    
        }
    })
    
})