<link rel='stylesheet' type='text/css' href='style.css'/>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<?php
session_start();
if ($_SESSION['status'] === TRUE)
    header('location: welcome.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Matcha</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
if ($_GET['signup'] == 'true')
    echo "<link rel='stylesheet' type='text/css' href='style.css'/>
    <h5 class = 'success'>You signed up succesfully! Log in now!</h5>";
else if ($_GET['login'] == 'false')
    echo "<h5 class = 'error'>Error loging in :(</h5>";
?>
        <h1 class = "center">Matcha</h1>
        <form action = "logging.php" method = "post">
            <input type = "text" class = "login" name = "username" placeholder = "username/email">
            <input type = "password" class = "login" name = "password" placeholder = "password">
            <input id = "button" type = "submit" action = "submit" value = "Log in" class = "login">
        </form>
        <a href = "signup.php"><h6 class = "center">Sign up here! It is awesome!</h></a>
    </body>
</html>
