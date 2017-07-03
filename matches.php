<?php
require 'includes.php';
require 'header.php';
require 'recommendation.class.php';

session_start();
$rec = new Recommend();
$rec->getMatches($_SESSION['uid']);
?>
