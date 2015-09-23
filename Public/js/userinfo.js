$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "index.php?c=user&a=userinfo",
        data: {},
        dataType: 'json',
        success: function(value) {
            if(value.status) {
                if(value.avatar) {
                    $('#avatar').attr("src", value.avatar);
                }
                $('#infolist').append(value.username);
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