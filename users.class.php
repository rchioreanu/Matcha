<?php
class Users
{
    private $DB_DSN = "mysql:host=localhost;dbname=db_matcha";
    private $DB_USER = "root";
    private $DB_PASS = "123456";
    protected $DB;
    private $photo_types = array("profile", "1", "2", "3", "4");

    function __construct ()
    {
        try {
            $this->DB = new PDO($this->DB_DSN, $this->DB_USER, $this->DB_PASS);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkUser ($email)
    {
        $query = "SELECT * FROM `users` WHERE `email` LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                if ($elem['email'])
                    return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function addUser ($fname, $lname, $bdate, $email, $password)
    {
        $hash = hash('whirlpool', $password);
        $query = "INSERT INTO `users` (`First Name`, `Last Name`, `Birthdate`, `email`, `password`) VALUES('$fname', '$lname', '$bdate', '$email', '$hash');";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function login ($email, $psw)
    {
        $hash = hash('whirlpool', $psw);
        $query = "SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$hash';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
            {
                if ($elem['email']) {
                    return ($elem['active']);
                }
            }
            return (-1);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function activateUser($email)
    {
        $query = "UPDATE users SET users.active = true WHERE users.email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function checkProfile ($email)
    {
        $query = "SELECT * FROM `users` WHERE `email` LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return ($elem['complete']);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getName ($email)
    {
        $query = "SELECT * FROM `users` WHERE `email` LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return array ($elem['First Name'], $elem['Last Name']);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addBio ($email, $bio)
    {
        $query = "UPDATE users SET Bio = '$bio' WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getBio ($email)
    {
        $query = "SELECT Bio FROM users WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return ($elem['Bio']);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addGender($email, $gender)
    {
        $query = "UPDATE users SET gender = '$gender' WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getGender($email)
    {
        $query = "SELECT gender FROM users WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return ($elem['gender']);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addOrientation ($email, $orientation)
    {
        $query = "UPDATE users SET orientation = '$orientation' WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getOrientation($email)
    {
        $query = "SELECT orientation FROM users WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return ($elem['orientation']);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addTags($email, $tags)
    {
        $query = "UPDATE users SET tags = '$tags' WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getTags($email)
    {
        $query = "SELECT tags FROM users WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return $elem['tags'];
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addName ($fname, $lname, $email)
    {
        $query = "UPDATE users SET `First Name` = '$fname', `Last Name` = '$lname' WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addEmail($oldemail, $newemail)
    {
        $query = "UPDATE users SET email  = '$newemail', active = false WHERE email LIKE '$oldemail';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function completeProfile ($email)
    {
        $query = "UPDATE users SET complete = true WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getUserId ($email)
    {
        $query = "SELECT * FROM users WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
                return $elem['id'];
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addPhoto ($type, $uid, $photoName)
    {
        if (!in_array($type, $this->photo_types))
            return FALSE;
        $toChange = "image_" . $type;
        $query = "INSERT INTO images (uid, $toChange) VALUES ('$uid', '$photoName') ON DUPLICATE KEY UPDATE
            $toChange = '$photoName';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getPhoto($uid, $type)
    {
        $query = "SELECT * FROM images WHERE uid LIKE '$uid';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem) {
                if ($elem["image_" . $type])
                    return $elem["image_" . $type];
                else
                    return "//placehold.it/100";
            }
            return "//placehold.it/100";
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getUserById($uid)
    {
        $query = "SELECT * FROM `users` WHERE id LIKE '$uid';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem) {
                return array ($elem['First Name'], $elem['Last Name'], $elem['email']);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    protected function checkOrientation($orientation1, $orientation2, $gender1, $gender2)
    {
        switch ($orientation1) {
        case 'h':
            switch ($gender1) {
            case 'o':
            case 'a':
            case 'p':
                return TRUE;
            case 'f':
                switch ($orientation2) {
                case 'h':
                    switch ($gender2) {
                    case 'm':
                        return TRUE;
                    default:
                        return FALSE;
                    }
                default:
                    return FALSE;
                }
            case 'm':
                switch ($orientation2) {
                case 'h':
                    switch ($gender2) {
                    case 'f':
                        return TRUE;
                    default:
                        return FALSE;
                    }
                }
            default:
                return FALSE;
            }
        case 'x':
            switch ($gender1) {
            case 'o':
            case 'a':
            case 'p':
                return TRUE;
            case 'f':
                switch ($orientation2) {
                case 'x':
                    switch ($gender2) {
                    case 'f':
                        return TRUE;
                    default:
                        return FALSE;
                    }
                default:
                    return FALSE;
                }
            case 'm':
                switch ($orientation2) {
                case 'x':
                    switch ($gender2) {
                    case 'm':
                        return TRUE;
                    default:
                        return FALSE;
                    }
                default:
                    return FALSE;
                }
            default:
                return FALSE;
            }
        default:
            return TRUE;
        }
    }
    public function checkCompatibility($haystack, $needle)
    {
        if ($haystack == $needle)
            return FALSE;
        $query = "SELECT * FROM users WHERE id LIKE '$haystack';";
        $query2 = "SELECT * FROM users WHERE id LIKE '$needle';";
        try {
            $statement = $this->DB->prepare($query);
            $statement2 = $this->DB->prepare($query2);
            $statement->execute();
            $statement2->execute();
            $rows = $statement->fetchAll();
            $rows2 = $statement2->fetchAll();
            foreach ($rows as $elem) {
                $orientation1 = $elem['orientation'];
                $gender1 = $elem['gender'];
            }
            foreach ($rows2 as $elem) {
                $orientation2 = $elem['orientation'];
                $gender2 = $elem['gender'];
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $this->checkOrientation($orientation1, $orientation2, $gender1, $gender2);
    }
    public function isActive ($uid)
    {
        $query = "SELECT active FROM users WHERE id LIKE '$uid';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem) {
                return $elem['active'];
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function resetPassword($email, $newpasswd)
    {
        $query = "UPDATE users SET password='$newpasswd' WHERE email LIKE '$email';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getAge($uid)
    {
        $query = "SELECT * FROM users WHERE id LIKE '$uid';";
        try {
            $statement = $this->DB->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            foreach ($rows as $elem)
            {
                $birthdate = new DateTime($elem['Birthdate']);
                $today = new DateTime('today');
                return $birthdate->diff($today)->y;
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
