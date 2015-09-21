$(document).ready(function() {

    $('#login').click(function() {
        var username = $('#username').val();
        var password = $('#password').val();
        
        if (username && password) {
            $.ajax({
                type: "POST",
                url: "index.php?c=index&a=login_data",
                data: {username: username, password: password},
                dataType: 'text',
                success: function(value) {
                    if(value == 'success') {
                        location.href = "index.php?c=index&a=stock_in";
                    } else {
                        alert('用户名或密码错误');
                    }
                },
                error: function() {

                }
            });
    
        }
    })
    
})