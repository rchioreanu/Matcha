<?php
require 'users.class.php';

session_start();
$users = new Users();
$active = $users->checkProfile($_SESSION['email']);
$_SESSION['active'] = $active;
$name = $users->getName($_SESSION['email']);
$_SESSION['fname'] = $name[0];
$_SESSION['lname'] = $name[1];
if (!$active)
	header ("Location: profile.php");
?>