$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "index.php?c=user&a=userinfo",
        data: {},
        dataType: 'json',
        success: function(value) {
            if(value.status) {
                // profile 信息设置
                if(value.avatar) {
                    $('#avatar').attr("src", value.avatar);
                }
                $('#infolist').append(value.username);

                // 权限设置
                // 管理员可以看到用户列表
                if(value.user_type != "0") {
                    $('#avatarlist').find("li").eq(1).hide();
                }

                // 普通用户 user_type 为 2
                if(value.user_type != "2") {
                    $('#mynav').find("li").eq(1).hide();
                    $('#mynav').find("li").eq(2).hide();
                } else {
                    $('#mynav').find("li").hide();
                    $('#mynav').find("li").eq(1).show();
                    $('#mynav').find("li").eq(2).show();
                }

            } else {
                console.log('没有登录');
                location.href = 'index.php?c=index&a=login';
            }
        },
        error: function() {

        }
    });

    $('#logout').click(function() {
        $.post("index.php?c=index&a=logout",{},function(){});
    });
})