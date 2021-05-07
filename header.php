<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="./style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<title>Login Page</title>
</head>
<body>
<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <?php
     session_start();
  if(isset($_SESSION["userId"]))
  {
    echo ' <a class="navbar-brand" href="dashboard.php">IS218-002</a>';
  }
  else
  {
    echo ' <a class="navbar-brand" href="index.php">IS218-002</a>';
  }
  
  ?>
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  d-flex justify-content-lg-end" id="navbarNavAltMarkup">
      <div class="navbar-nav ">
     

        <?php
       
          if(isset($_SESSION["userId"]))
          {
            echo ' <a class="nav-link" href="dashboard.php">Dashboard</a>';
           echo '<li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Account
           </a>
           <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
             <li><a class="dropdown-item" href="editUserName.php?edit=editUsername">Edit Username</a></li>
             <li><a class="dropdown-item" href="editAccount.php?edit=editPassword">Edit Password</a></li>
           </ul>
         </li>';
           echo '<a class="nav-link" href="includes/logout.inc.php">Logout</a>';
          }
          else 
          {
            echo '   <a class="nav-link active" aria-current="page" href="index.php">Home</a>';
            echo ' <a class="nav-link" href="login.php">Login</a>';
            echo '<a class="nav-link" href="signup.php">Sign Up</a>';
          }
        ?>
       
      </div>
    </div>
  </div>
</nav>
</div>

<div class="container-fluid">


