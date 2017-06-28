<?php
require_once 'location.class.php';

session_start();

$location = new Location();
if (isset($_GET['latitude']) && isset($_GET['longitude']))
{
    $location->updateLocation($_SESSION['uid'], $_GET['longitude'], $_GET['latitude']);
    echo TRUE;
}
else if ($_GET['error'] === TRUE)
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $details = json_decode(file_get_contents("http://api.ip2location.com/?%27.%20%27ip=$ip&key=demo&package=WS10&format=json"));
    $location->updateLocation($_SESSION['uid'], $details->longitude, $details->latitude);
    echo TRUE;
}
else
    echo FALSE;
?>
