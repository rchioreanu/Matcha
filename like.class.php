<?php
require 'users.class.php';

class Like extends Users
{
    public function checkLike ($from, $to)
    {
        $query = "SELECT * FROM likes WHERE liker LIKE '$from' AND liked LIKE '$to';";
        try {
            foreach ($this->DB->query($query) as $elem) {
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
            $this->DB->query($query);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
