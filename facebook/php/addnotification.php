<?php
	include 'connection.php';
	$u_id=$_POST['user_id'];
	$message=$_POST['message'];
	$sql = "INSERT INTO `notifications`( `user_id`,`message`) 
	VALUES ('$u_id','$message')";
	
	

	if (mysqli_query($connection, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($connection);
?>