<?php
require 'users.class.php';

class Block extends Users
{
    public function checkUser($blocker, $blocked)
    {
        $query = "SELECT * FROM block WHERE (blocker LIKE '$blocker' AND blocked LIKE '$blocked') OR (blocker LIKE '$blocked' AND blocked LIKE '$blocker');";
        try {
            foreach ($this->DB->query($query) as $elem) {
                if ($elem['blocker'])
                    return TRUE;
            }
            return FALSE;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return FALSE;
    }
    public function blockUser($blocker, $blocked)
    {
        $query = "INSERT INTO block (blocker, blocked) VALUES ('$blocker', '$blocked');";
        try {
            $this->DB->query($query);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
