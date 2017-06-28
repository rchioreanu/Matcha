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
            $this->DB->query($query);
        }
        catch (PDOEXception $e) {
            echo $e->getMessage();
        }
    }
}
?>
