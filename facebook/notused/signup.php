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
          <form class="login-form" method = "post" action="php/signup.php">
            <div class="mb-3">
              <input type="text" name="first_name" class="form-control" placeholder="First Name"
                required>
            </div>
			<div class="mb-3">
              <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                required>
            </div>
			<div class="mb-3">
              <input type="text" name="email" class="form-control" placeholder="Email address"
                required>
            </div>
            <div class="mb-3">
              <input type="password" name = "password" class="form-control" placeholder="Password"
                required>
            </div>
			<div class="mb-3">
              <input type="password" name = "confirmPassword" class="form-control" placeholder="Confirm Password"
                required>
            </div>
			<div class="mb-3">
			Gender
             <select name="gender" id="" class="form-control">
							
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							
			</select>
            </div>
			<div class="mb-3">
			Birthday
              <input type="date" name="date" value="2017-06-01">
            </div>
			
			
            <input type="submit" value="Sign Up" class="btn btn-custom btn-lg btn-block mt-3"></input>
            
          </form>
          <p class="pt-3 text-center"><b>Create a Page</b> for a celebrity, band or business.</p>
        </div>
      </div>
    </div>
  </body>
</html>