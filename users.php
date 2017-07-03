<?php
require 'users.class.php';

$users = new Users();
$tmp = $users->getUserById($_POST['uid']);
echo json_encode($tmp);
?>
