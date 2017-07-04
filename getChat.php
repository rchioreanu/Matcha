<?php
require_once 'chat.class.php';

session_start();
$chat = new Chat();
echo $chat->getChat($_SESSION['uid'], $_GET['to']);
?>
