
<?php
	require_once 'db.inc.php';
	require_once 'functions.inc.php';
// DB Connection


if (!isset($_POST["submit"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];


	$connection = new Database;
	
	if(emptyInputLogin($email,$password) !== false)
	{
		header("location: ../login.php?error=emptyinput");
		exit();
	}

	loginUser($connection->connection(), $email, $password);
}
else 
{
	header("location: ../login.php");
	exit();
}

