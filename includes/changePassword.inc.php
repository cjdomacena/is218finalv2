<?php

include_once "db.inc.php";
include_once "functions.inc.php";

if(!isset($_POST["submit"]))
{
	session_start();
	$username = $_SESSION["username"];
	$current_password = $_POST["password"];
	$new_password = $_POST["new_password"];


	$connection = new Database;

	$sql = "SELECT previous_password, second_password, password  FROM user WHERE userName = ?";
	$stmt = $connection->connection()->prepare($sql);
	$stmt->execute([$username]);
	$result = $stmt->fetch();


	$uppercase = preg_match("@[A-Z]@",$new_password);
	$lowercase = preg_match("@[a-z]@", $new_password);
	$number = preg_match("@[0-9]@", $new_password);

	if(!$uppercase || !$lowercase || !$number || (strlen($new_password) < 8 && strlen($new_password) > 30) )
	{
		header("location: ../editAccount.php?error=passworddoesnotmeetrequirements");
		exit();
	}


	if($new_password === $current_password)
	{
		header("location: ../editAccount.php?error=newpasswordsameascurrentone");
		exit();
	}


	echo $current_password;
	if($current_password == $result["password"])
	{
		if($new_password == $result["previous_password"] || $new_password == $result ["second_password"])
		{
			header("location: ../editAccount.php?error=passwordalreadyused");
			exit();
		}
		else 
		{
			// wil become new password
			$change_password = $new_password;

			// will become previous password (the password being changed)
			$changed_password = $current_password;

			// second_password will become the previous password

			$second_password = $result["previous_password"];

			echo "change_password: ". $change_password;
			echo "changed_password: ". $changed_password;
			echo "second_password: ". $second_password;
			// Make current password become previous, and previous come second and current become password
			$sql = "UPDATE user SET password = '$change_password', previous_password='$changed_password', second_password='$second_password' WHERE userName = '$username'";
			$stmt = $connection->connection()->prepare($sql);
			$stmt->execute();


			header("location:../dashboard.php?success=passwordchangedsuccessfully");

		}
	}
	else 
	{
		header("location: ../editAccount.php?error=currentpasswordincorrect");
		exit();
	}

}