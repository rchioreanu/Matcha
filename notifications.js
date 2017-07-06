function checkNotifications() {
    'use strict';
    $.ajax({
        method: "POST",
        url: "notifications.php",
        data: {
            purpose: 'check'
        },
        success: function(res) {
            var parsed = JSON.parse(res);
            var notifications = Object.keys(parsed).length;
            let notificationContent = "<li id = '" + parsed[0]['notifications_from'] + "_" + parsed[0]['type'] + "'><a id = '" + parsed[0]['notifications_from'] + "_" + parsed[0]['type'] + "a" + "'>";
            $("#notificationTab").html("Notifications (" + notifications + ")");
            for (let i = 0; i < notifications; i++) {
                if (parsed[i + 1])
                    notificationContent += parsed[i]['name'] + " " + parsed[i]['type'] + " you" + "</a></li><li id = '" + parsed[i + 1]['notifications_from'] + "_" + parsed[i + 1]['type'] + "'><a id = '" + parsed[i + 1]['notifications_from'] + "_" + parsed[i + 1]['type'] + "a" + "'>";
                else
                    notificationContent += parsed[i]['name'] + " " + parsed[i]['type'] + " you" + "</a></li>";
            }
            $("#notifications").html(notificationContent);
            for (let i = 0; i < notifications; i++) {
                $("#" + parsed[i]['notifications_from'] + "_" + parsed[i]['type']).click(function() {
                    $.ajax({
                        method: 'POST',
                        url: 'notifications.php',
                        data: {
                            purpose: 'see',
                            type: parsed[i]['type'],
                            notification_from: parsed[i]['notifications_from']
                        },
                        success: function(res) {
                        }
                    });
                    $("#" + parsed[i]['notifications_from'] + "_" + parsed[i]['type'] + 'a').attr('href', 'myprofile.php?user=' + parsed[i]['notifications_from']);
                    $("#" + parsed[i]['notifications_from'] + "_" + parsed[i]['type']).css('display', 'none');
                });
            }
        }
    });
}
checkNotifications();
setInterval(checkNotifications, 1000);
