<?php
class Users
{
	private $DB_DSN = "mysql:host=localhost;dbname=db_matcha";
	private $DB_USER = "root";
	private $DB_PASS = "123456";
	private $DB;
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
			foreach ($this->DB->query($query) as $elem)
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
			$this->DB->query($query);
			echo $fname .PHP_EOL.$lname.PHP_EOL.$bdate.PHP_EOL.$email.PHP_EOL.$password;
			echo "OK";
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
			foreach ($this->DB->query($query) as $elem)
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
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function checkProfile ($email)
	{
		$query = "SELECT * FROM `users` WHERE `email` LIKE '$email';";
		try {
			foreach ($this->DB->query($query) as $elem)
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
			foreach ($this->DB->query($query) as $elem)
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
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function getBio ($email)
	{
		$query = "SELECT Bio FROM users WHERE email LIKE '$email';";
		try {
			foreach ($this->DB->query($query) as $elem) {
				return ($elem['Bio']);
			}
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function addGender($email, $gender)
	{
		$query = "UPDATE users SET gender = '$gender' WHERE email LIKE '$email';";
		try {
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function getGender($email)
	{
		$query = "SELECT gender FROM users WHERE email LIKE '$email';";
		try {
			foreach ($this->DB->query($query) as $elem) {
				return ($elem['gender']);
			}
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function addOrientation ($email, $orientation)
	{
		$query = "UPDATE users SET orientation = '$orientation' WHERE email LIKE '$email';";
		try {
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function getOrientation($email)
	{
		$query = "SELECT orientation FROM users WHERE email LIKE '$email';";
		try {
			foreach ($this->DB->query($query) as $elem) {
				return ($elem['orientation']);
			}
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function addTags($email, $tags)
	{
		$query = "UPDATE users SET tags = '$tags' WHERE email LIKE '$email';";
		try {
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function getTags($email)
	{
		$query = "SELECT tags FROM users WHERE email LIKE '$email';";
		try {
			foreach ($this->DB->query($query) as $elem) {
				return $elem['tags'];
			}
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function addName ($fname, $lname, $email)
	{
		$query = "UPDATE users SET `First Name` = '$fname', `Last Name` = '$lname' WHERE email LIKE '$email';";
		try {
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function addEmail($oldemail, $newemail)
	{
		$query = "UPDATE users SET email  = '$newemail', active = false WHERE email LIKE '$oldemail';";
		try {
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function completeProfile ($email)
	{
		$query = "UPDATE users SET complete = true WHERE email LIKE '$email';";
		try {
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function getUserId ($email)
	{
		$query = "SELECT * FROM users WHERE email LIKE '$email';";
		try {
			foreach ($this->DB->query($query) as $elem)
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
			$this->DB->query($query);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function getPhoto($uid, $type)
	{
		$query = "SELECT * FROM images WHERE uid LIKE '$uid';";
		try {
			foreach ($this->DB->query($query) as $elem) {
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
}
?>
