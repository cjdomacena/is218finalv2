<?php


include_once "db.inc.php";

	session_start();
	$connection = new Database;

	
	if($_GET["sort"] == "asc")
	{
		// unset($_SESSION["todo"]);
		$sql = "SELECT * FROM todo WHERE user_id = ? ORDER BY urgency DESC";
		$stmt = $connection->connection()->prepare($sql);
		$stmt->execute([$_SESSION["userId"]]);
		$todo = $stmt->fetchAll();
		$_SESSION["todo"] = $todo;

	}
	if($_GET["sort"] == "desc")
	{
		// unset($_SESSION["todo"]);
		$sql = "SELECT * FROM todo WHERE user_id = ? ORDER BY urgency ASC";
		$stmt = $connection->connection()->prepare($sql);
		$stmt->execute([$_SESSION["userId"]]);
		$todo = $stmt->fetchAll();
		$_SESSION["todo"] = $todo;

	}
	header("location: ../dashboard.php");
	exit();
?>