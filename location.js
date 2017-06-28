$(function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(location) {
            $.ajax({
                type: 'GET',
                url: 'location.php',
                data: {
                    latitude: location.coords.latitude,
                    longitude: location.coords.longitude,
                },
                success: function(data) {
                    console.log(data);
                }
            });
        });
    }
    else {
        $.ajax({
            type: 'GET',
            url: 'location.php',
            data: {
                error: 'true'
            },
            success: function(data) {
                console.log("Asshole");
            }
        });
    }
});
