<?php
require_once 'recommendation.class.php';

class Search extends Recommend
{
    public function getAge($minage, $maxage, $uid, $how)
    {
        $minage = $minage < 18 ? 18 : $minage;
        $maxage = $maxage < 18 ? 99 : $maxage;
        $query = "SELECT id, CURDATE(),
            TIMESTAMPDIFF(YEAR,Birthdate,CURDATE()) AS age
            FROM users WHERE TIMESTAMPDIFF(YEAR,Birthdate,CURDATE()) >= $minage AND  TIMESTAMPDIFF(YEAR,Birthdate,CURDATE()) <= $maxage AND id NOT LIKE '$uid' ORDER BY age $how";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            return array_column($rows, 'id');
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function searchTags($tag, $uid)
    {
        $query = "SELECT * FROM users WHERE id NOT LIKE '$uid';";
        $users = array();
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem) {
                if (stripos($elem['tags'], $tag))
                    array_push($users, $elem['id']);
            }
            return $users;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function searchGender($gender, $uid)
    {
        if ($gender == 'm' || $gender == 'f')
            $query = "SELECT * FROM users WHERE gender LIKE '$gender';";
        else
            $query = "SELECT * FROM users WHERE gender NOT LIKE 'm' AND NOT LIKE 'f';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            return array_column($rows, 'id');
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getDistance($distance, $from)
    {
        $query = "SELECT * FROM location WHERE uid LIKE '$from';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            $lat = $rows[0]['Latitude'];
            $lon = $rows[0]['Longitude'];
            $query2 = "SELECT uid, ( 3959 * acos( cos( radians($lat) ) * cos( radians( Latitude ) )
                * cos( radians( Longitude ) - radians($lon) ) + sin( radians($lat) ) * sin(radians(Latitude)) ) ) AS distance
                FROM location
                HAVING distance < $distance
                ORDER BY distance;";
            $statement2 = $this->DB->prepare($query2);
            $statement2->execute();
            $toReturn = $statement2->fetchAll();
            return array_column($toReturn, 'uid');
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getUsers($tmp)
    {
        foreach ($tmp as $elem)
            $this->displayUserProfile($elem, FALSE);
    }
}
?>
