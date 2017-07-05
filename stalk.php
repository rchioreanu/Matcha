<?php
require_once 'stalk.class.php';

session_start();
$stalk = new Stalk();
$stalk->addStalker($_SESSION['uid'], $_GET['destuser']);
echo $_GET['destuser'];
?>
