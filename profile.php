<link rel = "stylesheet" href = "style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
require 'users.class.php';

session_start();
$users = new Users();
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
			<?php
				var_dump($_SESSION);
				if (!$_SESSION['active'])
					echo '
      <div class="col-md-9 personal-info">
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
              <textarea name = "bio" class="form-control" type="paragraph"  value="" required></textarea>
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
                  <option value="f">Female</option>
                  <option value="m">Male</option>
                  <option value="o">Other</option>
                  <option value="a">Did you just assume my gender?</option>
                  <option value="p">Person</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-lg-3 control-label">Sexual orientation: </label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select name = "orientation" id="user_orientation" class="form-control">
                  <option value="h">Heterosexual</option>
                  <option value="o">Homosexual</option>
                  <option value="b">Bisexual</option>
                  <option value="f">I just want to fuck, give me anything!</option>
                  <option value="a">Asexual</option>
                  <option value="q">Queer</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-md-3 control-label">Tags:</label>
            <div class="col-md-8">
              <input name = "tags" class="form-control" type="text" value="" required placeholder = "Enter like this: #lorem, #ipsum, #dolor">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input name = "psw" class="form-control" type="password" value="11111122333">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <button type="submit" class="btn btn-primary" >Update</button>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
