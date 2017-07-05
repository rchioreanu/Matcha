$(function() {
    $.ajax({
        url: 'stalk.php',
        cache: false,
        data: {
            destuser: destuser
        },
        success: function(res) {
            console.log(res);
        }
    });
});
