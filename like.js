$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: 'like.php',
        data: {
            myuser: myuser,
            destuser: destuser,
            purpose: 'check'
        },
        success: function(data) {
            if (data == 'true') {
                $("#like").css('display', 'none');
            }
        }
    });
    $("#like").click(function() {
        $.ajax({
            type: 'GET',
            url: 'like.php',
            data: {
                myuser: myuser,
                destuser: destuser,
                purpose: 'like'
            },
            success: function(data) {
                console.log(data);
                $("#like").css('display', 'none');
                location.reload();
            }
        });
        $.ajax({
            type: 'POST',
            url: 'notifications.php',
            data: {
                user: myuser,
                destuser: destuser,
                purpose: 'like'
            },
            success: function(res) {
                console.log(res);
            }
        });
    });
    $("#unlike").click(function() {
        $.ajax({
            type: 'GET',
            url: 'like.php',
            data: {
                myuser: myuser,
                destuser: destuser,
                purpose: 'unlike'
            },
            success: function(data) {
                console.log(data);
                $("#unlike").css('display', 'none');
                $("#match").css('display', 'none');
                location.reload();
            }
        });
        $.ajax({
            type: 'POST',
            url: 'notifications.php',
            data: {
                user: myuser,
                destuser: destuser,
                purpose: 'unlike'
            },
            success: function(res) {
                console.log(res);
            }
        });
    });
});
