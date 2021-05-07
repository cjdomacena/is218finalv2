
<?php


include_once "db.inc.php";

if(!isset($_POST["submit"]))
{
	session_start();
	// session_start();
	$connection = new Database;
	$todo_id = $_POST["todo_id"];
	$title = $_POST["title"];
	$description = $_POST["description"];
	$date = $_POST["date"];
	$urgency = $_POST["urgency"];
	$is_done = $_POST["is_done"];
	$user_id = $_SESSION["userId"];


	if(strtolower($is_done) == "yes")
	{
		$is_done = 1;
	}
	else if(strtolower($is_done == "no"))
	{
		$is_done = 0;
	}

	
	$sql = "UPDATE todo SET title = '$title', description = '$description', due_date = '$date', urgency = '$urgency', is_done = '$is_done' WHERE todo_id = '$todo_id' ";
	$stmt = $connection->connection()->prepare($sql);
	$stmt->execute();


	unset($_SESSION["todo"]);
	$new = "SELECT * FROM todo WHERE user_id = ?";
	$stmts = $connection->connection()->prepare($new);
	$stmts->execute([$user_id]);
	$todo = $stmts->fetchAll();
	$_SESSION["todo"] = $todo;


	$sql = "SELECT * FROM todo WHERE user_id = ? ORDER BY urgency DESC";
	$stmt = $connection->connection()->prepare($sql);
	$stmt->execute([$_SESSION["userId"]]);
	$todo = $stmt->fetchAll();
	$_SESSION["sorted"] = $todo;

	header("location: ../dashboard.php?success=editedSuccessfully");
	exit();

}
