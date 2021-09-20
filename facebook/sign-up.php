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
    <form class="signup_form" method = "post" action="php/signup.php">
      <div>
        <input class="firstname" type="text" name="first_name" placeholder="First name">
        <input class="lastname" type="text" name="last_name" placeholder="Last name">
        <input class="email" type="text" name="email" placeholder="Mobile number or Email">
        <input class="password" type="password" name="password" placeholder="Password">
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

</body>
</html>