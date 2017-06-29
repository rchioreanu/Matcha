<?php
require 'block.class.php';

class Recommend extends Users
{
    private function displayUserProfile($uid)
    {
        $query = "SELECT * FROM users WHERE id LIKE '$uid';";
        try {
            foreach ($this->DB->query($query) as $elem) {
                $fname = $elem['First Name'];
                $lname = $elem['Last Name'];
                $birthdate = new DateTime($elem['Birthdate']);
                $today = new DateTime('today');
                $age = $birthdate->diff($today)->y;
                $gender = $elem['gender'];
                $orientation = $elem['orientation'];
                $bio = $elem['Bio'];
                $tags = explode(",", $elem['tags']);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        echo '
            <div class="container">
                <div class="span3 well">
                    <center>
                    <a href="#aboutModal" data-toggle="modal" data-target="#' . $uid . '"><img src=' . $this->getPhoto($uid, 'profile') . ' name="aboutme" width="140" height="140" class="img-circle"></a>
                    <h3>' . $fname . " " . $lname . '</h3>
                    </center>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="' . $uid . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="myModalLabel">More About ' . $fname . '</h4>
                                </div>
                            <div class="modal-body">
                                <center>
                                <img src="' . $this->getPhoto($uid, 'profile') . '" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                <h3 class="media-heading">' . $fname . " " . $lname . '<small>, ' . $age . '</small></h3>
                                <span><strong>Interests: </strong></span>';
                                foreach ($tags as $tag)
                                    echo '<span class="label label-info">' . $tag . '</span>';
                                echo '
                                </center>
                                <hr>
                                <center>
                                <p class="text-left"><strong>Bio: </strong><br>' . $bio . '</p>
                                <br>
                                </center>
                            </div>
                            <div class="modal-footer">
                                <center>
                                <a href = "myprofile.php?user=' . $uid . '"<button type = "button" class = "btn btn-default">' . $fname . '\'s profile</button></a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">I\'ve heard enough about ' . $fname . '</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
    }
    public function suggestUser($uid)
    {
        $block = new Block();
        $query = "SELECT * FROM users WHERE 1;";
        try {
            foreach ($this->DB->query($query) as $elem) {
                $orientation = $elem['orientation'];
                $gender = $elem['gender'];
                if ($this->checkCompatibility($uid, $elem['id']) && !$block->checkUser($uid, $elem['id']))
                    $this->displayUserProfile($elem['id']);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
