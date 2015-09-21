$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "index.php?c=index&a=userinfo",
        data: {},
        dataType: 'json',
        success: function(value) {
            if(value.status) {
                $('#avatar').append(value.username);
            } else {
                location.href = 'index.php?c=index&a=login';
            }
        },
        error: function() {

        }
    });

    $('#logout').click(function() {
        $.post("index.php?c=index&a=logout",{},function(){});
    })
})