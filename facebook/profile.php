<?php
session_start();
$u_id = $_SESSION["u_id"];
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

    <title>My Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
  </head>

  <body>
<input type="hidden" id="u_id" name="u_id" value="<?php echo $u_id?>">

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
            <li><a href="friends.php">Friends</a></li>
			<li><a href="requests.php">Friend Requests</a></li>
            <li><a href="pending.php">Pending Requests</a></li>
            <li><a href="blocked.php">Blocked Users</a></li>
            <li class="active"><a href="#">My Profile</a></li>
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
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Edit Address</h3>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                          <input type="text" name="city" id="city" class="form-control" placeholder="City"></textarea>
                        </div>
						<div class="form-group">
                          <input type="text" name="region" id="region" class="form-control" placeholder="Region"></textarea>
                        </div>
						<div class="form-group">
                          <input type="text" name="country" id="country" class="form-control" placeholder="Country"></textarea>
                        </div>
						
						
                        <button type="submit" id="edit" >Edit</button>
                        
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default friends">
              <div class="panel-heading">
                <h3 class="panel-title">My Friends</h3>
              </div>
              <div class="panel-body">
                <ul>
                  <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>
                </ul>
                <div class="clearfix"></div>
                <a class="btn btn-primary" href="#">View All Friends</a>
              </div>
            </div>
            <div class="panel panel-default groups">
              <div class="panel-heading">
                <h3 class="panel-title">Notifications</h3>
              </div>
              <div class="panel-body">
               
                <div id="noti">
                
				  
				
                
				</div>
                <a id="showallnoti" class="btn btn-primary">View All Notifications</a>
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
				const response = await fetch('http://localhost/facebook/php/myprofile.php?u_id='+$('#u_id').val());
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
								<li><strong>Email: </strong>${data[i].email}</li>
								<li><strong>City: </strong>${data[i].city}</li>
								<li><strong>Region: </strong>${data[i].region}</li>
								<li><strong>Country: </strong>${data[i].country}</li>
								<li><strong>Gender: </strong>${data[i].gender}</li>
								<li><strong>DOB: </strong>${data[i].birth}</li>
								<input type="hidden" id="a_id" name="a_id" data-id="${data[i].address_id}">
							</ul>
						</div>`
			$("#myinfo").append(row);


		}
	}	
	</script>
	
<script>
$(document).ready(function(){
$(document).on('click','#edit',function(){
	var a_id = $('#a_id').data('id');
	var city = $('#city').val();
	var region = $('#region').val();
	var country = $('#country').val();
	$.ajax({
	url:'php/updateaddress.php',
	type:'POST',
	data:{
		a_id:a_id,
		city:city,
		region:region,
		country:country,
		},
	success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
					$('#myinfo').empty();
					$( document ).ready(function() {
						showinfo().then(results => {
					console.log(results);
					buildinfo(results);
					}).catch(error => {
					console.log(error.message);
					})
					});
					  
						
					
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
	});
});
});




async function shownoti(){
				const response = await fetch('http://localhost/facebook/php/getnotification.php?u_id='+$('#u_id').val());
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const results = await response.json();
				return results; 
}
$( document ).ready(function() {
				shownoti().then(results => {
					console.log(results);
					buildnoti(results);
				}).catch(error => {
					console.log(error.message);
				})
});

$(document).ready(function(){
$(document).on('click','#showallnoti',function(){
	$('#noti').empty();
	showallnoti().then(results => {
					console.log(results);
					buildnoti(results);
				}).catch(error => {
					console.log(error.message);
				})
});
});
async function showallnoti(){
				const response = await fetch('http://localhost/facebook/php/showallnotifications.php?u_id='+$('#u_id').val());
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const results = await response.json();
				return results; 
}
	function buildnoti(data){
		

		for (var i = 0; i < data.length; i++){
			var row = `<div class="group-item">
                  <img src="img/group.png" alt="">
                  
                  <p>${data[i].message}</p>
                </div>`
			$("#noti").append(row);


		}
	}	
</script>
  </body>
</html>
