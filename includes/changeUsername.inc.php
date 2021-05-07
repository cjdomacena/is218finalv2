<?php 

include_once "db.inc.php";

if(!isset($_POST["submit"]))
{
	session_start();
	$username = $_SESSION["username"];
	$password = $_POST["password"];
	$new_username = $_POST["new_username"];

	$connection = new Database;


	$sql = "SELECT password FROM user WHERE userName = '$username'";
	$stmt = $connection->connection()->prepare($sql);
	$stmt->execute();
	$pass = $stmt->fetch();

	if(preg_match("/[&='+,<>-]/", $new_username) || preg_match("/[.]{2,}/",$new_username))
		{
			header("location: ../editUserName.php?error=usernamedoesnotmeetrequirements");
			exit();
		}

	if($password === $pass[0])
	{
		$sql = "SELECT 1 FROM user WHERE userName = '$new_username'";
		$stmt = $connection->connection()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

	
		if(empty($result))
		{
			$sql = "UPDATE user SET userName = '$new_username' WHERE userName = '$username'";
			$stmt = $connection->connection()->prepare($sql);
			$stmt->execute();
			// unset($_SESSION["username"]);
			$_SESSION["username"] = $new_username;
		}
		else 
		{
			header("location:../editUserName.php?error=usernamealreadyexists");
			exit();
		}

	header("location:../editUserName.php?success=usernameupdate");
	}
	else 
	{
		header("location:../editUserName.php?error=invalidpassword");
		exit();
	}









}