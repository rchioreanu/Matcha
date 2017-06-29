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
            }
        })
    })
});
