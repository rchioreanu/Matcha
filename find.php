<?php
require_once 'search.class.php';
require_once 'header.php';
require_once 'includes.php';

session_start();
if ($_GET['lonely'])
    die();
if ($_GET['sort'])
    $sort = $_GET['sort_type'];
else
    $sort = "ASC";
$search = new Search();
$gender = $search->searchGender($_GET['gender'], $_SESSION['uid']);
$distance = $search->getDistance($_GET['radius'], $_SESSION['uid']);
if ($_GET['age'])
{
    if (!$_GET['minage'])
        $minage = 18;
    if (!$_GET['maxage'])
        $maxage = 99;
    $age = $search($minage, $maxage, $_SESSION['uid'], $sort);
}
if ($_GET['interest'])
    $interests = $search->searchTags($_GET['interest'], $_SESSION['uid']);
if ($age && $interests)
    $tmp = array_intersect($age, $interests, $gender, $distance);
else if ($age && !$interests)
    $tmp = array_intersect($age, $gender, $distance);
else if (!$age && $interests)
    $tmp = array_intersect($gender, $distance, $interests);
else
    $tmp = array_intersect($gender, $distance);
$search->getUsers($tmp);
?>
