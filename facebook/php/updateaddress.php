<?php 
include "connection.php";

$id = $_POST['a_id'];
$city=$_POST['city'];
$region=$_POST['region'];
$country=$_POST['country'];




$sql = "UPDATE addresses SET city = '$city', region = '$region', country = '$country' where id='$id'";
	if (mysqli_query($connection, $sql)) {
		
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($connection);

?>