<!DOCTYPE html>

<?php
include 'includes.php';
include 'header.php';
include 'recommendation.class.php';
require_once 'search.class.php';
session_start();
$users = new Users();
$active = $users->checkProfile($_SESSION['email']);
$_SESSION['active'] = $active;
$name = $users->getName($_SESSION['email']);
$_SESSION['fname'] = $name[0];
$_SESSION['lname'] = $name[1];
if (!$active)
    header ("Location: profile.php");
$rec = new Recommend();
$tmp = $rec->suggestUser($_SESSION['uid']);
if (!$tmp)
    echo("<h1 style = 'display: block; margin: 0 auto'>You are forever alone</h1>");
$search = new Search();
$userage = $users->getAge($_SESSION['uid']);
$age = $search->getAge($userage - 5, $userage + 5, $_SESSION['uid'], "ASC");
$distance = $search->getDistance(50, $_SESSION['uid']);
$final = array_intersect($tmp, $age, $distance);
if ($final)
    $search->getUsers($final);
else
    $search->getUsers($tmp);
?>
<script type = "text/javascript" src = "location.js"></script>
