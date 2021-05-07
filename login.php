<?php
include_once "header.php";
?>


<div class="container">
<?php
if(isset($_GET["success"]))
{
  if(isset($_GET["success"])== "signup")
  {
    echo '<div class="alert alert-success my-5" role="alert">
    Sign up sucessful!
  </div>';
  }
}
if(isset($_GET["error"]))
{
  if(isset($_GET["error"]) == "emaildoesnotexist")
  {
    echo '<div class="alert alert-danger my-5" role="alert">
    Incorrect Email/Username! Try again!
  </div>';
  }
  else if(isset($_GET["error"]) == "invalidpassword")
  {
    echo '<div class="alert alert-danger my-5" role="alert">
      Invalid Password!
  </div>';
  }
  else if(isset($_GET["error"]) == "emptyinput")
  {
    echo '<div class="alert alert-danger my-5" role="alert">
      Fill in all fields!
  </div>';
  }
  else 
  {
    echo '';
  }
  
}

?>
<section class="login-form">

	<h2>Log In</h2>
	<form action="includes/login.inc.php" method="post">
	<div class="mb-3">
    <label for="email" class="form-label">Enter Email or Username</label>
    <input type="text" class="form-control" name="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
	</form>

</section>
</div>

<?php
include_once "footer.php";
?>