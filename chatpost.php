<?php
require_once 'users.class.php';
require_once 'chat.class.php';
session_start();
if(isset($_SESSION['uid'])){
    $users = new Users();
    $user = $users->getUserById($_SESSION['uid'])[0];
    $chat = new Chat();
    $text = $_POST['text'];
    $msg = "<b>" . $user . ": </b>" . $text . "<br />";
    if (!$chat->getChat($_SESSION['uid'], $_POST['to']))
        $chat->firstChat($_SESSION['uid'], $_POST['to'], $msg);
    else
        $chat->addChat($_SESSION['uid'], $_POST['to'], $msg);
}
?>
