<?php
require 'users.class.php';

session_start();
$users = new Users();
var_dump($_POST);
var_dump($_SESSION);
$tmp = explode(",", trim($_POST['tags']));
foreach ($tmp as $elem)
{
	if (!preg_match("/\#\w+/", $elem))
		$error = "?error=true";
}
if ($error)
	header ("Location: profile.php" . $error);
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
$users->addBio($_SESSION['email'], $_POST['bio']);
$users->addGender($_SESSION['email'], $_POST['gender']);
$users->addOrientation($_SESSION['email'], $_POST['orientation']);
$users->addTags($_SESSION['email'], $_POST['tags']);
$users->addName($_POST['fname'], $_POST['lname'], $_SESSION['email']);
$users->completeProfile($_SESSION['email']);
$_SESSION['active'] = true;
if ($_SESSION['email'] != $_POST['email'])
{
	$users->addEmail($_SESSION['email'], $_POST['email']);
	session_destroy();
	header ("Location: index.php");
}
header ("Location: welcome.php");
?>
