<?php
include_once "header.php";
?>


<div class="container py-5">
<section class="signup-form">

<div class="alert alert-success my-5" role="alert">

  <h4 class="alert-heading">Welcome!</h4>
  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus sed modi, quis aliquid beatae molestiae accusantium repellat enim nulla ratione distinctio a voluptates laudantium illo!</p>
  <hr>
  <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo deleniti reprehenderit modi obcaecati facilis optio.</p>
</div>
<h2 class="my-3">Sign Up</h2>
  <!-- Error Check -->
  <?php
  if(isset($_GET["error"]))
  {
    if($_GET["error"] == "emptyinputs")
    {
      echo '<div class="alert alert-danger my-3" role="alert">
      Fill in all fields!
    </div>';
    }
    else if($_GET["error"] == "invalidUserName")
    {
      echo '<div class="alert alert-danger my-3" role="alert">
      Invalid Username!
    </div>';
    }
    else if($_GET["error"] == "invalidpassword")
    {
      echo '<div class="alert alert-danger my-3" role="alert">
      Password does not meet requirements!
    </div>';
    }
    else if($_GET["error"] == "invalidFirstName")
    {
      echo '<div class="alert alert-danger my-3" role="alert">
      First Name is invalid!
    </div>';
    }
    else if($_GET["error"] == "invalidLastName")
    {
      echo '<div class="alert alert-danger my-3" role="alert">
      Last Name is invalid!
    </div>';
    }
    else if($_GET["error"] == "emailAlreadyExists")
    {
      echo '<div class="alert alert-danger my-3" role="alert">
      Account already exists!
    </div>';
    }
  }

?>

	<form action="includes/signup.inc.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
	<div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-5 ">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" arial-describedby="password-text">
    <div id="password-text" class="form-text">
    <ul class="mt-3 list-unstyled">
    <li>
    Must be a minimum of 8 characters
    </li>
    <li>Must contain at least 1 number</li>
    <li>Must contain at least one uppercase character</li>
    <li>Must contain at least one lowercase character</li>
    </ul>
    </div>
  </div>

  <div class="mb-3">
    <label for="fName" class="form-label">First Name</label>
    <input type="text" class="form-control" name="fName">
  </div>
  <div class="mb-3">
    <label for="lName" class="form-label">Last Name</label>
    <input type="text" class="form-control" name="lName">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
	</form>

</section>

</div>

<?php
include_once "footer.php";
?>