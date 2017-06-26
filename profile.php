<?php include 'includes.php'; ?>
<script src = "image.js"></script>
<?php
require 'users.class.php';

session_start();
$users = new Users();
if ($_SESSION['status'] != true)
    header ("Location: index.php");
include 'header.php';
?>
<div class="container">
    <?php echo "<h1>" . $_SESSION['fname'] . "'s Profile" . "</h1>"; ?>
    <hr>
    <div class="row">
      <!-- left column -->
        <form action = "update.php" method = "POST" role = "form" class = "form-horizontal" id = "profile" enctype = "multipart/form-data">
      <div class="col-md-3">
        <div class="text-center">
        <img src="<?php echo $users->getPhoto($_SESSION['uid'], 'profile'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_profile">
          <h6>Upload a different photo...</h6>
          <input type="file" class="form-control" name = "profile" id = "input_profile">
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
        <h3>Personal info</h3>

          <div class="form-group required">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
            <input name = "fname" class="form-control" type="text" value="<?php echo $_SESSION['fname']; ?>" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
            <input name = "lname" class="form-control" type="text" value="<?php echo $_SESSION['lname']; ?>" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-3 control-label">Bio :</label>
            <div class="col-lg-8">
            <textarea name = "bio" class="form-control" type="paragraph" required><?php echo $users->getBio($_SESSION['email']); ?></textarea>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
            <input name = "email" class="form-control" type="text" value="<?php echo $_SESSION['email']; ?>" required>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-3 control-label">Gender: </label>
            <div class="col-lg-8">
              <div class="ui-select">
              <select name = "gender" id="user_gender" class="form-control">
                  <option id = "f" value="f">Female</option>
                  <option id = "m" value="m">Male</option>
                  <option id = "o" value="o">Other</option>
                  <option id = "a" value="a">Did you just assume my gender?</option>
                  <option id = "p" value="p">Person</option>
                <script>
                    var option = "<?php echo $users->getGender($_SESSION['email']); ?>";
                    $("#" + option).attr('selected', 'selected');
                </script>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-3 control-label">Sexual orientation: </label>
            <div class="col-lg-8">
              <div class="ui-select">
              <select name = "orientation" id="user_orientation" class="form-control" selected = "a">
                  <option id = "h" value="h">Heterosexual</option>
                  <option id = "x" value="x">Homosexual</option>
                  <option id = "b" value="b">Bisexual</option>
                  <option id = "e" value="e">I just want to fuck, give me anything!</option>
                <script>
                    var option = "<?php echo $users->getOrientation($_SESSION['email']); ?>";
                    $("#" + option).attr('selected', 'selected');
                </script>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-md-3 control-label">Interests:</label>
            <div class="col-md-8">
            <input name = "tags" class="form-control" value = "<?php echo $users->getTags($_SESSION['email']); ?>" type="text" data-role="tagsinput" required >
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
            <img src="<?php echo $users->getPhoto($_SESSION['uid'], '1'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_1">
              <h6>Upload a different photo...</h6>
              <input type="file" class="form-control" name = "1" id = "input_1">
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
            <img src="<?php echo $users->getPhoto($_SESSION['uid'], '2'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_2">
              <h6>Upload a different photo...</h6>
              <input type="file" class="form-control" name = "2" id = "input_2">
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
            <img src="<?php echo $users->getPhoto($_SESSION['uid'], '3'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_3">
              <h6>Upload a different photo...</h6>
              <input type="file" class="form-control" name = "3" id = "input_3">
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
            <img src="<?php echo $users->getPhoto($_SESSION['uid'], '4'); ?>" class="avatar img-circle img-responsive" alt="avatar" id = "image_4">
              <h6>Upload a different photo...</h6>
              <input type="file" class="form-control" name = "4" id = "input_4">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <button type="submit" class="btn btn-primary" >Update</button>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
            <a href = "logout.php"><button type = "button" class = "btn btn-default pull-right">Log out</button></a>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
