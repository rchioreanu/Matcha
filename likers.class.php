<?php
require_once 'recommendation.class.php';

class Likers extends Recommend
{
    public function getLikers($uid)
    {
        $query = "SELECT * FROM likes WHERE liked LIKE '$uid';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem) {
                if ($elem['liker'] != $elem['liked'])
                    $this->displayUserProfile($elem['liker'], FALSE);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
