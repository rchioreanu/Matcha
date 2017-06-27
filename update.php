<?php
require 'users.class.php';

session_start();

$uid = $_SESSION['uid'];
function upload ($name, $filename)
{
    $target_dir = "images/";
    $fileExtension = pathinfo($target_dir . basename($_FILES[$name]['name']), PATHINFO_EXTENSION);
    echo $fileExtension;
    $target_file = $target_dir . $filename . "." . $fileExtension;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES[$name]["tmp_name"]);
    if($check !== false)
    {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }
    else
    {
        $imgerr = "File is not an image.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES[$name]["size"] > 50000000)
    {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
    {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)
    {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    }
    else
    {
        if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file))
        {
            $users = new Users();
            $users->addPhoto($name, $_SESSION['uid'], $target_file);
            echo "The file ". basename( $_FILES[$name]["name"]). " has been uploaded.";
            unset($users);
        }
        else
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$users = new Users();
$error .= "&imgerror=" . str_replace(" ", "+", $imgerr);
if ($imgerror)
    header ("Location: profile.php" . $error);
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
//var_dump($_FILES);
if ($_FILES['profile']['name'])
    upload('profile', $uid . "_profile");
if ($_FILES['1']['name'])
    upload('1', $uid . "_1");
if ($_FILES['2']['name'])
    upload('2', $uid . "_2");
if ($_FILES['3']['name'])
    upload('3', $uid . "_3");
if ($_FILES['4']['name'])
    upload('4', $uid . "_4");
$users->addBio($_SESSION['email'], $_POST['bio']);
$users->addGender($_SESSION['email'], $_POST['gender']);
$users->addOrientation($_SESSION['email'], $_POST['orientation']);
$users->addTags($_SESSION['email'], $_POST['tags']);
$users->addName($_POST['fname'], $_POST['lname'], $_SESSION['email']);
$users->completeProfile($_SESSION['email']);
$_SESSION['active'] = true;
if ($_SESSION['email'] != $_POST['email'])
{
    $users->addEmail($_SESSION['email'], $_POST['email']);
    session_destroy();
    header ("Location: index.php");
}
header ("Location: myprofile.php");
?>
