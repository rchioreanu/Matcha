<?php
require_once 'includes.php';
require_once 'header.php';
require_once 'chat.class.php';
require_once 'users.class.php';

if (!$_POST['from'] || !$_POST['to'])
    header("Location: index.php");
$users = new Users();
$user = $users->getUserById($_POST['to'])[0] . " " . $users->getUserById($_POST['to'])[1];
?>
<link rel = "stylesheet" src = "chat.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo "Chat - " . $user; ?></title>
<link type="text/css" rel="stylesheet" href="chat.css" />
</head>

<div id="wrapper">
    <div id="menu">
    <p class="welcome">You are chatting with <b><?php echo $user; ?></b></p>
        <div style="clear:both"></div>
    </div>

    <div id="chatbox">
<?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
    echo $contents;
}
?>
</div>
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
function loadLog() {
    var oldScrollHeight = $("#chatbox").attr("scrollHeight") - 20;
    $.ajax({
    url: "getChat.php",
        cache: false,
        data: {
            to: "<?php echo $_POST['to']; ?>"
        },
        success: function(html) {
            $("#chatbox").html(html);
            var newScrollHeight = $("#chatbox").attr("scrollHeight") - 20;
            if (newScrollHeight > oldScrollHeight) {
                $("#chatbox").animate({ scrollTop: newScrollHeight }, 'normal');
            }
        }
    });
}
setInterval(loadLog, 500);
$(document).ready(function(){
    $("#submitmsg").click(function() {
        var clientmsg = $("#usermsg").val();
        $.post("chatpost.php", {text: clientmsg, to: "<?php echo $_POST['to']; ?>"});
        $("#usermsg").attr("value", "");
        return false;
    });
});
</script>
</body>
</html>
