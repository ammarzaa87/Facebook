<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Facebook - login or signup</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  
</head>
<body>
  <nav class="navbar">
    <img class="logo" src="img/fb.png">
    
  </nav>

  <section>
    <div class="logo_body">
  <img class="logobdy" src="img/fbbdy.png">
  <p class="like_font font1">Thanks for stopping by!</p>
  <p class="like_font">We hope to see you again soon.</p>
</div>

  <div class="signup_body">
    <p class="acc_crt">Create an account</p>
    <p class="free_hint">It's free and always will be.</p>
    <form class="signup_form" id="registration" method = "post" action="php/signup.php">
      <div>
        <input type="text" name="first_name" placeholder="First name" class="firstname" required>
        <input type="text" name="last_name" placeholder="Last name" class="lastname" required>
		<?php
					/* If email is already taken, print a danger alert that tells "email is already taken"*/
                    if (!empty($_SESSION["flash"])){
					?>
					<div class="alert alert-warning" role="alert">
					<?php
                    $x = $_SESSION["flash"];
                    echo $x;
					$_SESSION["flash"] = "";
					
				
					?>
					</div>
					<?php
					}
					?>
        <input class="email" type="text" name="email" placeholder="Mobile number or Email">
        <input id="password" class="password" type="password" name="password" placeholder="Password">
        <input class="password2" type="password" name="confirmPassword" placeholder="Confirm password">
      </div>
      <p class="birthday">Birthday</p>
      <div class="birth_date">
       <input class="birth_date" type="date" name="date" value="0-0-0">
      </div>

      <input type="radio" name="gender" value="male">
      <input type="radio" name="gender" value="female">

      <p class="font">Male</p>
      <p class="font font2">Female</p>
      <p class="agreement">By clicking Sign Up, you agree to our <a href="#">Terms, Data Policy and Cookies Policy.</a> You may receive SMS Notifications from us and can opt out any time.</p>

      <button class="signup">Sign Up</button>
      
    </form>
  </div>

  </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/register.js"></script>
</body>
</html>