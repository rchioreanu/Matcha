$(document).ready(function() {
    $("#block").click(function() {
        if (confirm('Are you sure you want to block this user?')) {
            $.ajax({
                type: 'GET',
                url: 'block.php',
                data: {
                    myuser: myuser,
                    destuser: destuser,
                    purpose: 'block'
                },
                success: function(data) {
                    console.log(data);
                    window.location.reload();
                }
            });
        }
    })
});
