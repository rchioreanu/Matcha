<?php
require_once 'includes.php';
session_start();
if (!$_SESSION['status'])
    header("Location: index.php");
?>
<!DOCTYPE html>
<html>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="welcome.php">Matcha</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="welcome.php">Home</a></li>
                    <li><a href="myprofile.php?user=<?php echo $_SESSION['uid']; ?>">My profile</a></li>
                    <li><a href="matches.php">My matches</a></li>
                    <li><a href="stalkers.php">My stalkers</a></li>
                    <li><a href="likers.php">My admirers</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown">
                          <a href="#" id = "notificationTab" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notifications (0) <span class="caret"></span></a>
                          <ul class="dropdown-menu" id = "notifications">
                          </ul>
                        </li>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <script>
    var user = "<?php echo $_SESSION['uid']; ?>";
    </script>
    <script src = "notifications.js" type = "text/javascript"></script>
    <script src = "chat.js" type = "text/javascript"></script>
</html>
