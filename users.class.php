<?php
class Users
{
	private $DB_DSN = "mysql:host=localhost;dbname=db_matcha";
	private $DB_USER = "root";
	private $DB_PASS = "123456";
	private $DB;

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
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
}
?>
