<?php
require 'users.class.php';

class Block extends Users
{
    public function checkUser($blocker, $blocked)
    {
        $query = "SELECT * FROM block WHERE (blocker LIKE '$blocker' AND blocked LIKE '$blocked') OR (blocker LIKE '$blocked' AND blocked LIKE '$blocker');";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem) {
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
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
