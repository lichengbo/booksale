$(document).ready(function() {
    $("#yzm-img").click(function(){
        $(this).attr("src",'public/php/code_char.php?' + Math.random());
        $("#yzm").focus();
    });

    $('#register').click(function() {
        var username = $('#username').val();
        var password = $('#password1').val();
        var password2 = $('#password2').val();
        var email = $('#email').val();

        if (username && password) {
            $.ajax({
                type: "POST",
                url: "index.php?c=index&a=register_data",
                data: {username: username, password: password, email: email},
                dataType: 'json',
                success: function(value) {
                    if(value['status']) {
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