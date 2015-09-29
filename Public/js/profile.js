$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "index.php?c=user&a=userinfo",
        data: {},
        dataType: 'json',
        success: function(value) {
            if(value.status) {
                $('#username').text(value.username);
                $('#email').text(value.email);
                if(value.avatar) {
                    $('#useravatar').attr("src", value.avatar);
                }

                if(value.user_type == "0") {
                    $('#user_type').text('超级管理员');
                } else if (value.user_type == "1") {
                    $('#user_type').text('管理员');
                } else {
                    $('#user_type').text('普通用户');
                }
            } else {
                location.href = 'index.php?c=index&a=login';
            }
        },
        error: function() {

        }
    });

    $('#useravatar').click(function() {
        $('#uploadimg').click();
    });

    $('#uploadimg').change(function(){
        $('#uploadform').ajaxSubmit({
            dataType: "json",
            success: function (value) {
                if(value.status) {
                    location.href = 'index.php?c=index&a=profile'
                } else {
                    alert('图片上传失败！');
                    console.log(value.info);
                }
            },
            error: function(){
                console.log( "ajax submit error");
            }
        });
    });

    function Focus() {
        $('.help').css('display','none');
    }

    function Blur() {
        var password1 = $('#resetpassword1').val();
        var password2 = $('#resetpassword2').val();

        if(password1 != password2) {
            $('.help').css('display', 'block');
        }
    }

    $('#resetpassword1').focus(Focus);
    $('#resetpassword2').focus(Focus);
    $('#resetpassword1').blur(Blur);
    $('#resetpassword2').blur(Blur);

    $('#reset').click(function() {
        var password1 = $('#resetpassword1').val();
        var password2 = $('#resetpassword2').val();

        if(password1 == password2) {
            $.ajax({
                type: "POST",
                url: "index.php?c=user&a=resetpassword",
                data: {newpassword: password1},
                dataType: 'json',
                success: function(value) {
                    if(value.status) {
                        alert('修改密码成功，请重新登录');
                        location.href = 'index.php?c=index&a=login';
                    } else {
                        alert('修改密码失败');
                    }
                },
                error: function() {

                }
            })
        }
    })
})