<?php include 'includes.php'; ?>
<script src = "image.js"></script>
<?php
require 'users.class.php';

session_start();
$users = new Users();
if ($_SESSION['status'] != true)
    header ("Location: index.php");
if (!isset($_GET['user']))
    header ("Location: index.php");
else
    $user = $_GET['user'];
if ($user != $_SESSION['uid'])
    $compatible = $users->checkCompatibility($_SESSION['uid'], $user);
else
{
    $myProfile = true;
    $compatible = -1;
}
if (!$compatible)
    header ("Location: index.php");
$userEmail = $users->getUserById($user)[2];
include 'header.php';
?>
<div class="container">
    <?php echo "<h1>" . $users->getUserById($user)[0] . " " . $users->getUserById($user)[1] . "</h1>"; ?>
    <hr>
    <div class="row">
      <!-- left column -->
        <form action = "update.php" method = "POST" role = "form" class = "form-horizontal" id = "profile" enctype = "multipart/form-data">
      <div class="col-md-3">
        <div class="text-center">
        <img src="<?php echo $users->getPhoto($user, 'profile'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_profile">
        </div>
      </div>
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
<?php
if (!$_SESSION['active'])
    echo '
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a>
          <i class="fa fa-coffee"></i>
          Before you can enjoy <strong>Matcha</strong>, you need to set up your profile.
        </div>';?>
        <?php if ($_GET['error'] == true)
                echo "<p class = 'error'>There was an error. Please try again!</p>"; ?>
        <?php
        if ($myProfile)
            echo "<a href = 'profile.php'><button type = 'button' class = 'btn btn-default pull-right'>Edit my profile</button></a>";
        else
            echo "<a href = 'like.php'><button type = 'button' class = 'btn btn-default pull-right'>Damn, son</button></a>";
        ?>
        <h3>Personal info</h3>

          <div class="form-group">
            <label class="col-lg-3 control-label">Bio :</label>
            <div class="col-lg-8">
            <textarea name = "bio" class="form-control" type="paragraph" readonly><?php echo $users->getBio($userEmail); ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Gender: </label>
            <div class="col-lg-8">
              <div class="ui-select">
                <div id = "gender" class = "form-control"></div>
                <script>
                    var option = "<?php echo $users->getGender($userEmail); ?>";
                    if (option == "f")
                        $("#gender").text('Female');
                    else if (option == 'm')
                        $("#gender").text('Male');
                    else if (option == 'o')
                        $("#gender").text('Other');
                    else if (option == 'a')
                        $("#gender").text('Did you just assume my gender?');
                    else if (option == 'p')
                        $("#gender").text('Person');
                </script>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Sexual orientation: </label>
            <div class="col-lg-8">
              <div class="ui-select">
                <div id = "orientation" class = "form-control"></div>
                <script>
                    var option = "<?php echo $users->getOrientation($userEmail); ?>";
                    if (option == 'h')
                        $("#orientation").text('Heterosexual');
                    else if (option == 'x')
                        $("#orientation").text('Homosexual');
                    else if (option == 'b')
                        $("$orientation").text('Bisexual');
                    else if (option == 'e')
                        $("#orientation").text('I just want to fuck, give me anything!');
                </script>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Interests:</label>
            <div class="col-md-8">
            <div class = "form-control bootstrap-tagsinput" data-role = "tagsinput"><?php echo $users->getTags($userEmail); ?></div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
            <img src="<?php echo $users->getPhoto($user, '1'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_1">
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
            <img src="<?php echo $users->getPhoto($user, '2'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_2">
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
            <img src="<?php echo $users->getPhoto($user, '3'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_3">
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
            <img src="<?php echo $users->getPhoto($user, '4'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_4">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
          </div>
        <?php
        if (!$myProfile)
            echo "<a href = 'block.php'><button type = 'button' class = 'btn btn-default pull-right'>Block the user</button></a>";
        ?>
        </form>
      </div>
  </div>
</div>
<hr>
