<?php 
include "connection.php";

$id = $_POST['id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$gender=$_POST['gender'];



$sql = "UPDATE users SET first_name = '$fname', last_name = '$lname', email = '$email', gender = '$gender' where id='$id'";
	if (mysqli_query($connection, $sql)) {
		
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($connection);

?>