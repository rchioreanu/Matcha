<?php
require_once 'users.class.php';
require_once 'chat.class.php';
session_start();
if(isset($_SESSION['uid'])){
    $users = new Users();
    $user = $users->getUserById($_SESSION['uid'])[0];
    $chat = new Chat();
    $text = $_POST['text'];
    $msg = "<div class='msgln'>(".date("g:i A").") <b>".$user."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>";
    if (!$chat->getChat($_SESSION['uid'], $_POST['to']))
        $chat->firstChat($_SESSION['uid'], $_POST['to'], base64_encode($msg));
    else
        $chat->addChat($_SESSION['uid'], $_POST['to'], base64_encode($msg));
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$user."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>
