<?php
require 'users.class.php';

session_start();
$key = hash('whirlpool', $_SESSION['key']);
$email = $_SESSION['email'];
if ($key != $_POST['hash'])
    header ("Location: login.php?login=false");
else
{
    $users = new Users();
    $users->activateUser($email);
    $_SESSION['status'] = true;
    header ("Location: welcome.php");
}
?>
