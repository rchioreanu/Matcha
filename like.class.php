<?php
require 'users.class.php';

class Like extends Users
{
    public function checkLike ($from, $to)
    {
        $query = "SELECT * FROM likes WHERE liker LIKE '$from' AND liked LIKE '$to';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem) {
                if ($elem['liker']){
                    echo 'true';
                    return;
                }
                else
                    echo 'false';
            }
            return 'false';
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        echo 'false';
    }
    public function addLike($from, $to)
    {
        $query = "INSERT INTO likes(liker, liked) VALUES ('$from', '$to');";
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
