<?php

class Database 
{

	private $hostname;
	private $username;
	private $password;
	private $dbname;
	public $conn;


	public function connection()
	{
	

		$this->hostname = "localhost";
		$this->username = "root";
		$this->password="";
		$this->dbname="users";
		
		// Connect to database
		try{
			$this->conn = 
			new PDO(
				"mysql:host=$this->hostname; 
				 dbname=$this->dbname;", 
				 $this->username, $this->password);
				 echo"Connected Successfully!";
		}catch(PDOException $e)
		{
			header("Content-type: text/plain");
			echo "Connection Failed". $e->getMessage();
		}



		return $this->conn;
	}
}
