$(document).ready(function() {
    // 获取 cookie 记录的用户名和密码
    $('#username').val($.cookie('username'));
    $('#password').val($.cookie('password'));

    // 表单验证
    var passwordIsTrue = false;
    var codeCharIsTrue = false;

    // 密码格式正则表达式
    var passwordPattern = /^([a-z]|[A-Z]|[0-9]){6,16}$/;

    //  验证密码格式函数
    function checkPassword() {
        var len = $(this).val().length;
        if(len < 6) {
            $('#passwordErrorInfo').show();
            passwordIsTrue = false;
        } else if (len > 16) {
            $('#passwordErrorInfo').show();
            $('#passwordErrorInfo').text('密码过长应小于或等于16');
            passwordIsTrue = false;
        } else {
            if(!passwordPattern.test($('#password').val())) {
                $('#passwordErrorInfo').show();
                $('#passwordErrorInfo').text('密码格式不正确，应由数字和字母组成');
                passwordIsTrue = false;
            } else {
                passwordIsTrue = true;
            }
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

    $('#yzm').focus(Focus);
    $('#username').focus(Focus);
    $('#password').focus(function() {
        $('#usernameErrorInfo').hide();
    });
    $('#password').focus(Focus);
    $('#password').blur(checkPassword);

    // 检测验证码是否正确
    $('#yzm').blur(checkCodechar)

    $("#yzm-img").click(function(){
        $(this).attr("src",'public/php/code_char.php?' + Math.random());
        $("#yzm").focus();
    });

    $('#login').click(function() {
        var username = $('#username').val();
        var password = $('#password').val();
        var isremember = $('#rememberme').prop("checked");
        
        if (username && passwordIsTrue && codeCharIsTrue) {
            $.ajax({
                type: "POST",
                url: "index.php?c=index&a=login_data",
                data: {username: username, password: password, isremember: isremember},
                dataType: 'json',
                success: function(result) {
                    if(result.status) {
                        if(result.user_type != "2") {
                            location.href = "index.php?c=index&a=stock_in";
                        } else {
                            location.href = "index.php?c=index&a=sale";
                        }
                        return true;
                    } else {
                        //alert('用户名或密码错误');
                        $('#usernameErrorInfo').show();
                        // 在此 return false 自带校验不失效，但是显示错误提示后会刷新
                        return false;
                    }
                },
                error: function() {
                    console.log('login ajax submit error');
                }
            });
    
        }

        // 在此 return false 可以实现无刷新，但是自带校验失效
        //return false;
    })
    
})