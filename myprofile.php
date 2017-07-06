<?php
include 'includes.php';
require 'block.class.php';
include 'like.class.php';
require_once 'recommendation.class.php';
session_start();
?>
<script src = "image.js"></script>
<?php
$users = new Users();
$block = new Block();
$likes = new Like();
$rec = new Recommend();
if ($_SESSION['status'] != true)
    header ("Location: index.php");
if (!isset($_GET['user']))
    $user = $_SESSION['uid'];
else
    $user = $_GET['user'];
if ($user != $_SESSION['uid'])
    $compatible = $users->checkCompatibility($_SESSION['uid'], $user);
else
{
    $myProfile = true;
    $compatible = -1;
}
if ($block->checkUser($_SESSION['uid'], $user))
    header ("Location: index.php");
if (!$compatible)
    header ("Location: index.php");
$userEmail = $users->getUserById($user)[2];
$match = !$myProfile ? $rec->match($user, $_SESSION['uid']) : FALSE;

include 'header.php';
?>
<script>
var myuser = "<?php echo $_SESSION['uid']; ?>";
var destuser = "<?php echo $_GET['user']; ?>";
</script>
<script src = "like.js"></script>
<script src = "block.js"></script>
<?php
if ($compatible && !$match && !$myProfile)
    echo "<script src = 'watch.js' type = 'text/javascript'></script>";
?>
<script src = "stalk.js"></script>
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
if ($myProfile)
    echo "<a href = 'profile.php'><button type = 'button' class = 'btn btn-default pull-right'>Edit my profile</button></a>";
else
    echo "<a href = '#'><button id = 'like' type = 'button' class = 'btn btn-default pull-right'>Damn, son</button></a>";
if ($match)
    echo "<a href = '#'><button id = 'unlike' type = 'button' class = 'btn btn-default pull-right'>HATE YOU!</button></a>";
if ($match)
    echo "<button id = 'match' type = 'button' class = 'btn btn-default pull-right'>Chat</button>";
?>
<script>
function post(path, params, method) {
    method = method || "post";
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
         }
    }
    document.body.appendChild(form);
    form.submit();
}
$("#match").click(function() {
    post("chat.php", {
        from: myuser,
        to: destuser
    });
});
</script>
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
          <!--</div>-->
          <div class="form-group">
            <label class="col-md-3 control-label">People who think this is hot:</label>
            <div class="col-md-8">
            <div id = "likenr" class = "form-control bootstrap-tagsinput" data-role = "tagsinput"><?php echo $likes->getLikes($user); ?></div>
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
    echo "<a href = '#'><button id = 'block' type = 'button' class = 'btn btn-default pull-right'>Block the user</button></a>";
?>
        </form>
      </div>
  </div>
</div>
<hr>
