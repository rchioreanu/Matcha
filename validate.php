<?php
require 'users.class.php';
require 'validation.class.php';

$users = new Users;
$val = new Validation();
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$bdate = $_POST['bdate'];
$email = $_POST['email'];
$remail = $_POST['remail'];
$psw = $_POST['psw'];
$rpsw = $_POST['rpsw'];
$get = "?";
$error = false;
if ($email != $remail)
{
	$error = true;
	$get .= "email=match&";
}

if ($psw != $rpsw)
{
	$error = true;
	$get .= "psw=match&";
}

if (!$val->checkEmail($email))
{
	$error = true;
	$get .= "email=false&";
}

if (!$val->checkPassword($psw))
{
	$error = true;
	$get .= "psw=false&";
}

if (!$val->checkBirthDate($bdate))
{
	$error = true;
	$get .= "bdate=false&";
}

if ($users->checkUser($email))
{
	$error = true;
	$get .= "user=registered";
}

if ($error === true)
	header ("Location: signup.php$get");
else
{
	$status = $users->addUser($fname, $lname, $bdate, $email, $psw);
	if ($status)
		header ("Location: index.php?signup=true");
}
?>
