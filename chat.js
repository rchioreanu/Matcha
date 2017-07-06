function checkChat() {
    $.ajax({
        method: 'POST',
        url: 'chatnotification.php',
        success: function(res) {
        }
    });
}
$(function() {
    setInterval(checkChat, 1000);
});
