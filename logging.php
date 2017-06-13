<link rel = 'stylesheet' type = 'text/css' href = 'style.css'>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<?php
require 'users.class.php';

session_start();
if ($_SESSION['status'] === TRUE)
	header ("Location: welcome.php");
$users = new Users();
$username = $_POST['username'];
$password = $_POST['password'];
$status = $users->login($username, $password);
if ($status == 1)
{
	$_SESSION['status'] = true;
	header ("Location: welcome.php");
}
else if ($status == 0)
{
	$key = rand();
	$_SESSION['key'] = $key;
	$_SESSION['email'] = $username;
	$content = "Your unique activation code is: " . hash('whirlpool', $key);
	mail($username, "Activate your account!", $content);
	echo "<h1 class = 'center'>Enter the verification code we sent you on email:</h1>";
	echo "<form action = 'activate.php' method = 'post'>";
	echo "<input type = 'text' class = 'login' name = 'hash'>";
	echo "<input type = 'submit' class = 'login' value = 'Submit' />";
	echo "</form>";
}
else if ($status == -1)
	header ("Location: login.php?login=false");
?>
