<?php include_once "header.php"

?>

<?php

if(isset($_GET["edit"]))
{
  if(isset($_GET["edit"]) == "editUsername")
  {
    echo '<div class="container"><div class="alert alert-warning mt-5 mb-5" role="alert">

    <h4 class="alert-heading">Edit Username</h4>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus sed modi, quis aliquid beatae molestiae accusantium repellat enim nulla ratione distinctio a voluptates laudantium illo!</p>
  </div></div>';
  }
}

if(isset($_GET["success"]))
{
  if(isset($_GET["success"]) == "usernameupdate")
  {
    echo '<div class="container"><div class="alert alert-success mt-5 mb-5" role="alert">

    <h4 class="alert-heading">Username Updated!!</h4>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus sed modi, quis aliquid beatae molestiae accusantium repellat enim nulla ratione distinctio a voluptates laudantium illo!</p>
  </div></div>';
  }
}


?>

<div class="container py-5">
<section class="edit-form">

	<form action="includes/changeUsername.inc.php" method="post">

  <fieldset disabled>
	<div class="mb-3">
    <label for="current" class="form-label">Current Username</label>
	<?php
		echo '<input type="text" class="form-control" name="current" value="' . $_SESSION["username"] . '">';
		?>
  </div>
  </fieldset>


  <div class="mb-3">
		<label for="username" class="form-label">Enter New Username</label>
		<?php
		echo '<input type="text" class="form-control" name="new_username" required>';
		?>
  </div>

  <fieldset disabled>
	<div class="mb-3">
    <label for="email" class="form-label">Email address</label>
	<?php
		echo '<input type="text" class="form-control" name="email" value="' . $_SESSION["email"] . '">';
		?>
  </div>
  </fieldset>

  
  <div class="mb-5 ">
    <label for="password" class="form-label">Verify Current Password</label>
    <input type="password" class="form-control" name="password" arial-describedby="password-text" required>
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
<fieldset disabled>
  <div class="mb-3">
    <label for="fName" class="form-label">First Name</label>
	<?php
		echo '<input type="text" class="form-control" name="fName" value="' . $_SESSION["firstName"] . '">';
		?>
  </div>
  <div class="mb-3">
    <label for="lName" class="form-label">Last Name</label>
	<?php
		echo '<input type="text" class="form-control" name="lName" value="' . $_SESSION["lastName"] . '">';
		?>
  </div>
  </fieldset>
  <button type="submit" class="btn btn-primary">Submit</button>
	</form>

</section>

</div>












<?php include_once "footer.php"?>