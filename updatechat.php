<?php
require_once 'chat.class.php';

session_start();
$chat = new Chat();
$chat->updateChat($_SESSION['uid'], $_GET['to']);
?>
