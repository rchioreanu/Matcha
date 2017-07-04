<?php
require_once 'chat.class.php';

session_start();
$chat = new Chat();
//echo base64_decode($chat->getChat($_SESSION['uid'], $_POST['to']));
echo base64_decode($chat->getChat($_SESSION['uid'], $_POST['to']));
?>
