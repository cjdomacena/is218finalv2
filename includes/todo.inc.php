<?php

include_once "db.inc.php";

if (!isset($_POST["submit"])) {
	session_start();
	$connection = new Database;

	$title = $_POST["title"];
	$description = $_POST["description"];
	$date = $_POST["date"];
	$urgency = $_POST["urgency"];
	$user_id = $_SESSION["userId"];
	$is_done = $_SESSION["is_done"];
	echo "$is_done";

	$sql = "INSERT INTO todo(title, due_date,description, urgency, user_id, is_done)
	values(?,?,?,?,?,?)";
	$stmt = $connection->connection()->prepare($sql);
	$stmt->execute([$title, $date, $description, $urgency, $user_id, false]);



	unset($_SESSION["todo"]);
	$sql = "SELECT * FROM todo WHERE user_id = ?";
	$stmt = $connection->connection()->prepare($sql);
	$stmt->execute([$user_id]);
	$todo = $stmt->fetchAll();
	$_SESSION["todo"] = $todo;

	unset($_SESSION["sorted"]);
	$sql = "SELECT * FROM todo WHERE user_id = ? ORDER BY urgency DESC";
	$stmt = $connection->connection()->prepare($sql);
	$stmt->execute([$_SESSION["userId"]]);
	$todo = $stmt->fetchAll();
	$_SESSION["sorted"] = $todo;

	header("location: ../dashboard.php?sucess=taskadded");
	exit();
}




