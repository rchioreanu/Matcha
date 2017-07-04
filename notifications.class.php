<?php
require_once 'recommendation.class.php';

class Notifications extends Users
{
    public function addNotification($from, $to, $type)
    {
        $query = "INSERT INTO notifications(notifications_from, notifications_to, type)
            VALUES('$from', '$to', '$type');";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getNotification($uid)
    {
        $query = "SELECT notifications_from, type FROM notifications WHERE notifications_to LIKE '$uid' AND notifications_read LIKE false;";
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

    public function seeNotification($uid, $type, $from)
    {
        $query = "UPDATE notifications SET notifications_read=true WHERE (notifications_from LIKE '$from' AND notifications_to LIKE '$uid' AND type LIKE '$type');";
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
