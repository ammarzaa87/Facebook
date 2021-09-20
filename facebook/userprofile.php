<?php
session_start();
$u_id = $_SESSION["u_id"];
$f_id = $_GET['f_id'];
if(empty($_SESSION['u_id'])){
    header("Location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
  </head>

  <body>
<input type="hidden" id="u_id" name="u_id" value="<?php echo $u_id?>">
<input type="hidden" id="f_id" name="f_id" value="<?php echo $f_id?>">
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            
            <li><a href="home.php">Home</a></li>
            <li class="active"><a href="#">User Profile</a></li>
			<li><a href="php/logout.php">Log Out</a></li>
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="profile">
              <div id="myinfo" class="row">
                
                    
                  
              </div><br><br>
            
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default friends">
              <div class="panel-heading">
                <h3 class="panel-title">More Friends</h3>
              </div>
              <div class="panel-body">
                <ul>
                  <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>
                </ul>
                <div class="clearfix"></div>
                <a class="btn btn-primary" href="#">View All Friends</a>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </section>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
	
	<script>
		async function showinfo(){
				const response = await fetch('http://localhost/facebook/php/myprofile.php?u_id='+$('#f_id').val());
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const results = await response.json();
				return results; 
			}
			

			$( document ).ready(function() {
				showinfo().then(results => {
					console.log(results);
					buildinfo(results);
				}).catch(error => {
					console.log(error.message);
				})
			});
		function buildinfo(data){
		

		for (var i = 0; i < data.length; i++){
			var row = ` <div class="col-md-4">
							<img src="img/user.png" class="img-thumbnail" alt="">
							</div>
							<div class="col-md-8">
							<ul id="myinfo">
							
								<li><strong>Name: </strong>${data[i].first_name} ${data[i].last_name}</li>
								<li><strong>City: </strong>Boston</li>
								<li><strong>State: </strong>Massachusetts</li>
								<li><strong>Gender: </strong>${data[i].gender}</li>
								<li><strong>DOB: </strong>${data[i].birth}</li>
							</ul>
						</div>`
			$("#myinfo").append(row);


		}
	}	
	</script>
	

  </body>
</html>
