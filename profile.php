<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<link rel = "stylesheet" href = "style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
require 'users.class.php';

session_start();
$users = new Users();
if ($_SESSION['status'] != true)
	header ("Location: index.php");
?>
<div class="container">
	<?php echo "<h1>" . $_SESSION['fname'] . "'s Profile" . "</h1>"; ?>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          <input type="file" class="form-control">
        </div>
      </div>
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
			<?php
				var_dump($_SESSION);
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
        <form action = "update.php" method = "POST" role = "form" class = "form-horizontal">
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
                  <option id = "o" value="o">Homosexual</option>
                  <option id = "b" value="b">Bisexual</option>
                  <option id = "e" value="e">I just want to fuck, give me anything!</option>
                  <option id = "s" value="s">Asexual</option>
                  <option id = "q" value="q">Queer</option>
				<script>
					var option = "<?php echo $users->getOrientation($_SESSION['email']); ?>";
					$("#" + option).attr('selected', 'selected');
				</script>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-md-3 control-label">Tags:</label>
            <div class="col-md-8">
			<input name = "tags" class="form-control" type="text" placeholder = "#enter, #like, #this" required value = "<?php echo $users->getTags($_SESSION['email']); ?>">
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
