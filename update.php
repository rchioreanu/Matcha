<?php
var_dump($_POST);
$tmp = explode(",", trim($_POST['tags']));
foreach ($tmp as $elem)
{
	if (!preg_match("/\#\w+/", $elem))
		$error = "?error=true";
}
if ($error)
	header ("Location: profile.php" . $error);

var_dump($tmp);
var_dump($error);
?>
