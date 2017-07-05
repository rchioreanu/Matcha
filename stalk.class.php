<?php
require_once 'recommendation.class.php';

class Stalk extends Recommend
{
    public function addStalker($from, $to)
    {
        $query = "DELETE FROM `stalkers` WHERE `stalker_from` LIKE '$from' AND `stalker_to` LIKE '$to';
        INSERT INTO `stalkers`(`stalker_from`, `stalker_to`) VALUES('$from', '$to');";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getStalkers($uid)
    {
        $query = "SELECT * FROM stalkers WHERE stalker_to LIKE '$uid';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem) {
                if ($elem['stalker_from'] != $elem['stalker_to'])
                    $this->displayUserProfile($elem['stalker_from'], FALSE);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
