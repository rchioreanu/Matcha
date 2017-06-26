<?php
require 'users.class.php';

class Recommend extends Users
{
    public function test()
    {
        try {
            $query = "SELECT * FROM users WHERE 1;";
            foreach ($this->DB->query($query) as $elem)
                var_dump($elem);
            echo "OK";
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
