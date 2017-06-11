<link rel = "stylesheet" type = "text/css" href = "style.css">
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
crossorigin="anonymous"></script>
<?php
session_start();
if ($_SESSION['status'] === TRUE)
	header ("Location: welcome.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Matcha</title>
</head>
<body>
	<h1 class = "center">Sign up!</h1>
	<form action = "validate.php" method = "post">
		<p class = "signup">First name:</p>
		<input type = "text" class = "login" name = "fname" required>
		<p class = "signup">Last name:</p>
		<input type = "text" class = "login" name = "lname" required>
		<p class = "signup">Birthdate:</p>
		<input type = "date" class = "login" name = "bdate" id = "bdate" required>
		<div id = "alert" class = "signup"></div>
		<p class = "signup">Email: </p>
		<input type = "text" class = "login" name = "email" id = "email" required>
		<div id = "emailAlert" class = "signup"></div>
		<p class = "signup">Repeat email: </p>
		<input type = "text" class = "login" name = "remail" id = "remail" required>
		<div id = "remailAlert" class = "signup"></div>
		<p class = "signup">Password: </p>
		<input type = "password" class = "login" name = "psw" id = "psw" required>
		<div id = "pswAlert" class = "signup"></div>
		<p class = "signup">Repeat password: </p>
		<input type = "password" class = "login" name = "rpsw" id = "rpsw" required>
		<div id = "rpswAlert" class = "signup"></div>
		<input type = "submit" class = "login" id = "submit">
	</form>
	<script src = "signup.js"></script>
</body>
