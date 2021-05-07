<?php


function emptyInputSignup($email, $password, $fName, $lName)
{
	
	if(empty($email) || empty($password) || empty($fName) || empty($lName))
	{
		return true;
	}

	return false;
}

function invaliduserName($userName)
{
	if(preg_match("/[&='+,<>-]/", $userName) || preg_match("/[.]{2,}/",$userName))
	{
		return true;
	}
	
	return false;
}


function invalidfName($fName)
{

	if(preg_match("/^[0-9]*$/", $fName))
	{
		return true;
	}
	return false;
}

function invalidlName($lName)
{

	if(preg_match("/[0-9]/", $lName))
	{
		return true;
	}
	return false;
}

function invalidPassword($password)
{
	$uppercase = preg_match("@[A-Z]@",$password);
	$lowercase = preg_match("@[a-z]@", $password);
	$number = preg_match("@[0-9]@", $password);

	if(!$uppercase || !$lowercase || !$number || (strlen($password) < 8 && strlen($password) > 30) )
	{
		return true;
	}
	return false;
}

// Check exists

function accountExist($connection,$email,$userName)
{
	$sql = "SELECT * FROM user WHERE userName = '$userName' OR email = '$email'";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$userName, $email]);
	$result = $stmt->fetchAll();
	if($result)
	{
		return true;
	}
	return false;
}

function createUser($connection, $userName, $email, $fName, $lName, $password)
{
	$sql = "INSERT INTO user(userName, email, fName, lName, password) 
	values('$userName','$email','$fName','$lName','$password' )";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	header("location: ./../login.php?success=signup");
	exit();
}


// Login functions
function isEmail($input)
{
	if(filter_var($input, FILTER_VALIDATE_EMAIL))
	{
		return true;
	}
	return false;
}


function emptyInputLogin($email, $password)
{
	if(empty($email) || empty($password))
	{
		return true;
	}
	return false;
}

function loginUser($connection, $user,$password)
{
	$emailExists = accountExist($connection, $user, $user);
	if($emailExists === false)
	{
		header("location: ../login.php?error=emaildoesnotexist");
		exit();
	}
	else 
	{
	$sql = "SELECT  * FROM user WHERE userName = ? OR email =  ?";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$user, $user]);
	 $result = $stmt->fetch();

	 
	if($result["password"] === $password)
	{
		session_start();
		$_SESSION["username"] = $result["userName"];
		$_SESSION["email"] = $result["email"];
		$_SESSION["firstName"] = $result["fName"];
		$_SESSION["lastName"] = $result["lName"];
		$_SESSION["userId"] = $result["id"];
		// $_SESSION["password"] = $result["password"];	

		$sql = "SELECT * FROM todo WHERE user_id = ?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$_SESSION["userId"]]);
		$todo = $stmt->fetchAll();
		$_SESSION["todo"] = $todo;
	
		$sql = "SELECT * FROM todo WHERE user_id = ? ORDER BY urgency DESC";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$_SESSION["userId"]]);
		$todo = $stmt->fetchAll();
		$_SESSION["sorted"] = $todo;
		header("location: ./../dashboard.php");
		exit();
	}
	else 
	{
		header("location:../login.php?error=invalidpassword");
		exit();
	}
}
}

