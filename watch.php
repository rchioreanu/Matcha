<?php
require_once 'notifications.class.php';

session_start();
$not = new Notifications();
$not->addNotification($_SESSION['uid'], $_GET['user'], 'watched');
?>
