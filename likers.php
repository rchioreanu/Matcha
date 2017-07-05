<?php
include 'includes.php';
include 'header.php';
require_once 'likers.class.php';

session_start();
$likers = new Likers();
$likers->getLikers($_SESSION['uid']);
?>
