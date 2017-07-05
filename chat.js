function checkChat() {
    $.ajax({
        method: 'POST',
        url: 'chatnotification.php',
        success: function(res) {
            console.log(res);
        }
    });
}
$(function() {
    setInterval(checkChat, 1000);
});
