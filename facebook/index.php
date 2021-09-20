<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="w3hubs.com">
    <link href="css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <div class="container">
      <div class="row align-items-center justify-content-center vh-100">
        <div class="col-md-7">
          <img src="https://static.xx.fbcdn.net/rsrc.php/y8/r/dF5SId3UHWd.svg" class="w-50">
          <h3>Facebook helps you connect and share with the people in your life.</h3>
        </div>
        <div class="col-md-5">
          <form class="login-form" method = "post" action="php/login.php">
		  <?php
				/* If email or password are wrong, print a danger alert that tells "Please check your email or password"*/
				if (!empty($_SESSION["flash"])){
				?>
				<div class="alert alert-danger" role="alert">
				<?php
			
                    $x = $_SESSION["flash"];
					echo $x;
					$_SESSION["flash"] = "";
					
				?>
				</div>
				<?php
				}
				?>
            <div class="mb-3">
              <input type="text" name="email" class="form-control" placeholder="Email address"
                required>
            </div>
            <div class="mb-3">
              <input type="password" name = "password" class="form-control" placeholder="Password"
                required>
            </div>
            <input type="submit" value="Login" class="btn btn-custom btn-lg btn-block mt-3"></input>
            <div class="text-center pt-3 pb-3">
              <a href="#" class="">Forgotten password?</a>
              <hr>
              <a href="sign-up.php" type="button" class="btn btn-success btn-lg mt-3">Create New Account</a>
            </div>
          </form>
          <p class="pt-3 text-center"><b>Create a Page</b> for a celebrity, band or business.</p>
        </div>
      </div>
    </div>
  </body>
</html>