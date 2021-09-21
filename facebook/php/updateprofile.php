<?php 
include "connection.php";

$id = $_POST['id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$date = $_POST['date'];



$sql = "UPDATE users SET first_name = '$fname', last_name = '$lname', birth = '$date' where id='$id'";
	if (mysqli_query($connection, $sql)) {
		
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($connection);

?>