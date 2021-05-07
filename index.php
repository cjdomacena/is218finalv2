<?php
include_once "header.php";
?>

<?php

if(isset($_GET["session"]))
{
	if($_GET["session"] == "logout")
	{
		echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
		Logged out successfully!
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>';
	}
}
// session_start();

if(isset($_SESSION["userId"]))
{
	// print_r($_SESSION["todo"]);
	echo "Hello " . $_SESSION["firstName"];
}
else 
{
	echo "<h1>Welcome</h1>";
}
?>
<?php
include_once "footer.php";
?>