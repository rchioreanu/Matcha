<?php
require 'users.class.php';

session_start();
$users = new Users();
if (!$users->checkProfile($_SESSION['email']))
	header ("Location: profile.php");
?>
