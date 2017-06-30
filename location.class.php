<?php
require_once 'users.class.php';

class Location extends Users
{
    public function updateLocation($uid, $longitude, $latitude)
    {
        $query = "INSERT INTO location (uid, Latitude, Longitude)
            VALUES ('$uid', '$latitude', '$longitude')
            ON DUPLICATE KEY UPDATE
                Latitude='$latitude', Longitude='$longitude';";
        try {
            $statement = $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOEXception $e) {
            echo $e->getMessage();
        }
    }
}
?>
