<?php
require_once 'users.class.php';

class Chat extends Users
{
    public function updateChat($from, $to)
    {
        $log = strlen($this->getChat($from, $to));
        $query = "DELETE FROM lastlength WHERE chat_from LIKE '$from' AND chat_to LIKE '$to';
        INSERT INTO lastlength (chat_from, chat_to, chat_length) VALUES ('$from', '$to', '$log');";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addChat($from, $to, $log)
    {
        $log2 = $log;
        $log = strlen($this->getChat($from, $to));
        $query = "UPDATE chat SET log=CONCAT(log, '$log2') WHERE (chat_1 LIKE '$from' AND chat_2 LIKE '$to') OR (chat_1 LIKE '$to' AND chat_2 LIKE '$from');";
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
        $log2 = $log;
        $log = strlen($log2);
        $query = "INSERT INTO chat (chat_1, chat_2, log) VALUES('$from', '$to', '$log2');";
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
        $query = "SELECT * FROM chat WHERE (`chat_1` LIKE '$from' AND `chat_2` LIKE '$to') OR (`chat_1` LIKE '$to' AND `chat_2` LIKE '$from');";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return $elem['log'];
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function newChat($uid)
    {
        $query = "SELECT * FROM lastlength WHERE chat_from LIKE '$uid';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            return $rows;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
