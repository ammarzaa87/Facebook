<?php
	include 'connection.php';
	$u_id=$_POST['u_id'];
	$f_id=$_POST['f_id'];
	$sql = "INSERT INTO `blocks`( `blocker_id`, `blocked_id`) 
	VALUES ('$u_id','$f_id')";
	
	

	if (mysqli_query($connection, $sql)) {
		$sql="delete from friends where user_id='$u_id' AND friend_id='$f_id'";
		$stmt2 = $connection->prepare($sql);
		$stmt2->execute();
		
		$sql="delete from friends where user_id='$f_id' AND friend_id='$u_id'";
		$stmt2 = $connection->prepare($sql);
		$stmt2->execute();
		
		
		$sql1="Select * from users where id='$f_id'";
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