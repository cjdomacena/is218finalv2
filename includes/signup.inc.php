<?php
require_once "db.inc.php";
$connection = new Database;

if(!isset($_POST["submit"]))
{
	$userName = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];

	
	require_once "functions.inc.php";

	// Check inputs for errors
	if(emptyInputSignup($userName,$email, $password, $fName, $lName) !== false)
	{
		header("location: ../signup.php?error=emptyinputs");
		exit();
	}

	if(invaliduserName($userName) !== false)
	{
		
		header("location: ../signup.php?error=invalidUserName");
		exit();
	}

	if(invalidfName($fName) !== false)
	{
		header("location: ../signup.php?error=invalidFirstName");
		exit();
	}

	if(invalidlName($lName) !== false)
	{
		header("location: ../signup.php?error=invalidLastName");
		exit();
	}

	if(invalidPassword($password) !== false)
	{
		header("location: ../signup.php?error=invalidpassword");
		exit();
	}

	if(accountExist($connection->connection(), $email, $userName) !== false)
	{
		header("location: ../signup.php?error=emailAlreadyExists");
		exit();
	}

	createUser($connection->connection(), $userName, $email, $fName, $lName, $password);
	
}
else 
{
	header("location: ../index.php");
}
