<?php
require_once 'users.class.php';

class Chat extends Users
{
    public function addChat($from, $to, $log)
    {
        $query = "UPDATE chat SET log=CONCAT(log, '$log') WHERE (chat_1 LIKE '$from' AND chat_2 LIKE '$to') OR (chat_1 LIKE '$to' AND chat_2 LIKE '$from');";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function firstChat($from, $to, $log)
    {
        $query = "INSERT INTO chat (chat_1, chat_2, log) VALUES('$from', '$to', '$log');";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getChat($from, $to)
    {
//        $query = "SELECT * FROM chat WHERE (`chat_1` LIKE '$from' AND `chat_2` LIKE '$to') OR (`chat_1` LIKE '$to' AND `chat_2 LIKE '$from');";
        $query = "SELECT * FROM chat";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return $elem['log'];
//            echo base64_decode($rows[0]['log']);
            //return FALSE;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
