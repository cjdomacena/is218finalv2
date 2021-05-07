<?php 


include_once "db.inc.php";
session_start();
$connection = new Database();
if(!isset($_POST["submit"]))
{


	$userName = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];
	
	$counter = 0;

	if(checkUsername($connection->connection(),$userName) || checkPassword($connection->connection(), $password, $userName))
	{
		header("location: ../editAccount.php?error=doesnotmeetrequirements");
	}
	else
	{
		$sql = "UPDATE todo SET userName = ?, password = ?";
		$stmt = $connection->connection()->prepare($sql);
		$stmt->execute([$userName, $password]);


		
		header("location: ../dashboard.php");
	}


}

function checkUsername($connection, $userName)
{
	$sql = "SELECT 1 FROM user WHERE userName = ?'";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$userName]);
	$result = $stmt->fetchAll();
	return $result;
}

function checkPassword($connection, $password, $userName)
{
	
	$uppercase = preg_match("@[A-Z]@",$password);
	$lowercase = preg_match("@[a-z]@", $password);
	$number = preg_match("@[0-9]@", $password);

	if(!$uppercase || !$lowercase || !$number || (strlen($password) < 8 && strlen($password) > 30) )
	{
		return true;
	}
	return false;


	$sql = "SELECT * FROM users WHERE userName = ?";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$userName]);

	$result = $stmt->fetchAll();
	if($password === $result["password"])
	{
		return true;
	}
	else
	{
		if($result["previous_password"] == $password || $result["second_password"] == $password)
		{
			return true;
		}
	}

	
}

