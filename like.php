<?php
session_start();
require 'like.class.php';

$like = new Like();
$myuser = $_SESSION['uid'];
$destuser = $_GET['destuser'];
if ($_GET['purpose'] == 'check')
{
    echo $like->checkLike($myuser, $destuser);
}
else if ($_GET['purpose'] == 'like')
{
    echo $like->addLike($myuser, $destuser);
}
?>
