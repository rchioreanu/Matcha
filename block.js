$(document).ready(function() {
    $("#block").click(function() {
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
        })
    })
});
