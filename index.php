<?php
session_start();

if (!$_SESSION['status'])
	header ("Location: login.php");

else if ($_SESSION['status'] === TRUE)
	header ("Location: welcome.php");

?>
