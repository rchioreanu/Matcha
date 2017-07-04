<?php
require 'notifications.class.php';

session_start();
$notifications = new Notifications();
$users = new Users();
if ($_POST['purpose'] == 'like')
{
    echo $_POST['user'];
    echo $_POST['destuser'];
    $notifications->addNotification($_POST['user'], $_POST['destuser'], 'liked');
}
else if ($_POST['purpose'] == 'check')
{
    $rows = $notifications->getNotification($_SESSION['uid']);
    foreach($rows as &$elem) {
        $elem['name'] = $users->getUserbyId($elem['notifications_from'])[0] . " " . $users->getUserById($elem['notifications_from'])[1];
    }
    echo json_encode($rows);
}
else if ($_POST['purpose'] == 'see')
{
    $notifications->seeNotification($_SESSION['uid'], $_POST['type'], $_POST['notification_from']);
}
?>
