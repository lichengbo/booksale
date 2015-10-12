$(document).ready(function() {
    var currentUserType = $('#user_type').text();
    $('#userTypeSelect').val(currentUserType);

    $('#userTypeBtn').click(function() {
        var uid = $('#userid').text();
        var changeUserType = $('#userTypeSelect').val();

        if(currentUserType != changeUserType) {
            $.ajax({
                type: 'post',
                url: 'index.php?c=user&a=editoruser_data',
                data: {uid: uid, changeUserType: changeUserType},
                dataType: 'json',
                success: function(result) {
                    alert(result.info);
                    if(result.status) {
                        window.location.reload();
                    }
                }
            })
        }
    });
})