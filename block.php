<?php
session_start();
require 'block.class.php';

$block = new Block();
$myuser = $_SESSION['uid'];
$destuser = $_GET['destuser'];
if ($_GET['purpose'] == 'check')
{
    echo $block->checkUser($myuser, $destuser);
}
else if ($_GET['purpose'] == 'block')
{
    echo $block->blockUser($myuser, $destuser);
}
?>
