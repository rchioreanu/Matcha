<?php
function upload ($name, $filename)
{
	$target_dir = "images/";
	$target_file = $target_dir . $filename;
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
	// Check if file already exists
	if (file_exists($target_file))
	{
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES[$name]["size"] > 500000)
	{
		$imgerr = "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
	{
		$imgerr = "Sorry, only JPG, JPEG, PNG files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0)
	{
		$imgerr = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	}
	else
	{
		if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file))
		{
			echo "The file ". basename( $_FILES[$name]["name"]). " has been uploaded.";
		}
		else
		{
			$imgerr = "Sorry, there was an error uploading your file.";
		}
	}
}

session_start();
var_dump($_FILES);
upload("photo_1");
$tmp = explode(",", trim($_POST['tags']));
foreach ($tmp as $elem)
{
	if (!preg_match("/\#\w+/", $elem))
		$error = "?error=true";
}
if ($error)
	$error .= "&imgerror=" . str_replace(" ", "+", $imgerr);
if ($error)
	header ("Location: profile.php" . $error);
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
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
//header ("Location: welcome.php");
?>
