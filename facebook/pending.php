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

    <title>Social Network</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/search.css" rel="stylesheet">
	
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
            <li class="active"><a href="#">Pending Requests</a></li>
            <li><a href="blocked.php">Blocked Users</a></li>
            <li><a href="profile.php">My Profile</a></li>
			<li><a href="php/logout.php">Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>




    <section>

      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="members">
              <h1 class="page-header">Pending Requests</h1>
			  
			  <div id="myTable">
			  
			  
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
	async function showpending(){
				const response = await fetch('http://localhost/facebook/php/showpending.php?u_id='+$('#u_id').val());
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const results = await response.json();
				return results; 
			}
			

			$( document ).ready(function() {
				showpending().then(results => {
					buildTable(results);
				}).catch(error => {
					console.log(error.message);
				})
			});
	function buildTable(data){
		//var table = document.getElementById('myTable');

		for (var i = 0; i < data.length; i++){
			var row = `<div class="row member-row">
					
						   <div class="col-md-3">
							  <img src="img/user.png" class="img-thumbnail" alt="">
							  <div class="text-center">
								${data[i].first_name}
								${data[i].last_name}
							  </div>
							   <div class="text-center">
							   ${data[i].gender}
							  </div>
							</div>
						
						
							<div class="col-md-3">
							  <p><a id="acc" data-id=${data[i].id} class="btn btn-success btn-block"><i class="fa fa-paper-plane"></i>Request Sent</a></p>
							</div>
						
							<div class="col-md-3">
							  <p><a id="rmv" data-id=${data[i].id} class="btn btn-primary btn-block"><i class="fa fa-remove"></i>Remove request</a></p>
							</div>
							<div class="col-md-3">
							  <p><a id="block" data-id=${data[i].id} class="btn btn-danger btn-block"><i class="fa fa-ban"></i>Block</a></p>
							</div>
					
				</div>`
			$("#myTable").append(row);


		}
	}		
		

	</script>
	
<script>


$(document).ready(function(){
$(document).on('click','#rmv',function(){
	//alert($(this).data('id'));
	var f_id = $(this).data('id');
	var u_id = $('#u_id').val();
	
	$.ajax({
	url:'php/removerequest.php',
	type:'POST',
	data:{
		f_id:f_id,
		u_id:u_id,
		},
	success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						var ffname = dataResult.fname;
						var flname= dataResult.lname;
						var message = "You removed the request you sent to "+ffname+" "+flname;
						$.ajax({
				url: "php/addnotification.php",
				type: "POST",
				data: {
					user_id:u_id,
					message: message,
					
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#myTable').empty();
						$( document ).ready(function() {
								showpending().then(results => {
									
									buildTable(results);
								}).catch(error => {
									console.log(error.message);
								})
						});
						$('#noti').empty();
						$( document ).ready(function() {
							shownoti().then(results => {
								
								buildnoti(results);
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
			
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
	});
});
});

$(document).ready(function(){
$(document).on('click','#block',function(){
	//alert($(this).data('id'));
	var f_id = $(this).data('id');
	var u_id = $('#u_id').val();
	
	$.ajax({
	url:'php/block.php',
	type:'POST',
	data:{
		f_id:f_id,
		u_id:u_id,
		},
	success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						var fname = dataResult.fname;
						var lname= dataResult.lname;
						var message = "You Blocked "+fname+" "+lname+", your request has been canceled";
						$('#myTable').empty();
						$( document ).ready(function() {
								showpending().then(results => {
									
									buildTable(results);
								}).catch(error => {
									console.log(error.message);
								})
							});
						$.ajax({
				url: "php/addnotification.php",
				type: "POST",
				data: {
					user_id:u_id,
					message: message,
					
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#noti').empty();
						$( document ).ready(function() {
								shownoti().then(results => {
									
									buildnoti(results);
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
				
					buildnoti(results);
				}).catch(error => {
					console.log(error.message);
				})
});

$(document).ready(function(){
$(document).on('click','#showallnoti',function(){
	$('#noti').empty();
	showallnoti().then(results => {
					
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
