$(document).ready(function() {
    // 表单验证
    $yzmistrue = false;

    // 重新输入时恢复样式
    function Focus() {
        $(this).next().css('display','none');
    }

    $('#yzm').focus(Focus);

    // 检测验证码是否正确
    $('#yzm').blur(function() {
        $.post("index.php?c=index&a=checkyzm", {value:$('#yzm').val()}, function(value){
            if(value.status) {
                $yzmistrue = true;
            } else {
                $yzmistrue = false;
                $('#yzm').next().css('display', 'block');
            }
        })
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

        if (username && password && $yzmistrue && isagree) {
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