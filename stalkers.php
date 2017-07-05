<?php
include 'includes.php';
include 'header.php';
require_once 'stalk.class.php';

session_start();
$stalk = new Stalk();
$stalk->getStalkers($_SESSION['uid']);
?>
