$(document).ready(function() {
    // 获取 cookie 记录的用户名和密码
    $('#username').val($.cookie('username'));
    $('#password').val($.cookie('password'));
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

    $('#login').click(function() {
        var username = $('#username').val();
        var password = $('#password').val();
        var isremember = $('#rememberme').prop("checked");
        
        if ($yzmistrue && username && password) {
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
                        alert('用户名或密码错误');
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