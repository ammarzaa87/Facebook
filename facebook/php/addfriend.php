<?php
	include 'connection.php';
	$u_id=$_POST['u_id'];
	$f_id=$_POST['f_id'];
	$sql = "INSERT INTO `friends`( `user_id`, `friend_id`,`is_accepted`) 
	VALUES ('$u_id','$f_id',0)";
	
	

	if (mysqli_query($connection, $sql)) {
		$sql1="Select * from users where id='$u_id'";
		$stmt1 = $connection->prepare($sql1);
		$stmt1->execute();
		$result = $stmt1->get_result();
		$row = $result->fetch_assoc();
		echo json_encode(array("statusCode"=>200,"fname"=>$row['first_name'],"lname"=>$row['last_name']));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($connection);
?>