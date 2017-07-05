<style>
input, form {
display: block;
margin: 0 auto;
}
</style>
<link rel = "stylesheet" href = "style.css">
<?php
session_start();
if (!isset($_POST['email']))
    echo '
<form method = "POST" action = "forgot.php">
<input type = "text" placeholder = "email" name = "email" />
<input type = "submit" value = "Forgot">
</form>
';
if (isset($_POST['email']))
{
    $_SESSION['key'] = hash('whirlpool', rand());
    $subject = "Reset yout account";
    $mail = "Your key is: " . $_SESSION['key'];
    mail($_POST['email'], $subject, $mail);
    $_SESSION['email'] = $_POST['email'];
    header("Location: forgot.php?mail=true");
}
if ($_GET['mail'] == true)
{
    echo "Enter your confirmation code:";
    echo "<form method = 'POST' action = 'forgot.php'>";
    echo "<input type = 'text' name = 'key' /><br />";
    echo "New password: <br />";
    echo "<input type = 'password' name = 'passwd' /><br />";
    echo "Repeat: <br />";
    echo "<input type = 'password' name = 'repasswd' /><br />";
    echo "<input type = 'submit' value = 'Submit'>";
    echo "</form>";
}
if ($_SESSION['key'] == $_POST['key'])
{
    require_once 'users.class.php';
    require_once 'validation.class.php';
    $users = new Users();
    $val = new Validation();
    if ($_POST['passwd'] == $_POST['repasswd'] && $val->checkPassword($_POST['passwd']))
    {
        $users->resetPassword($_SESSION['email'], hash('whirlpool', $_POST['passwd']));
        echo "OK";
        header("Location: index.php?success=true");
    }
    else
        header ("Location: index.php?error=true");
}
