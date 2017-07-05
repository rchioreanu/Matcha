$(function() {
    $.ajax({
        url: 'watch.php',
        cache: false,
        data: {
            user: destuser
        }
    });
});
