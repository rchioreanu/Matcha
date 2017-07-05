<?php
require_once 'chat.class.php';
require_once 'users.class.php';
require_once 'notifications.class.php';

session_start();
$chat = new Chat();
$users = new Users();
$not = new Notifications();
$tmp = $chat->newChat($_SESSION['uid']);
foreach ($tmp as $elem)
{
    $to = $chat->newChat($elem['chat_to']);
    foreach ($to as $to2)
    {
        if ($to2['chat_to'] == $_SESSION['uid'] && $to2['chat_length'] > $elem['chat_length'])
            $not->addNotification($to2['chat_from'], $_SESSION['uid'], 'chatted');
    }
}
?>
