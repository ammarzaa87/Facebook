<?php
	include 'connection.php';
	$u_id=$_POST['u_id'];
	$f_id=$_POST['f_id'];
	$sql = "INSERT INTO `friends`( `user_id`, `friend_id`,`is_accepted`) 
	VALUES ('$u_id','$f_id',1)";
	
	

	if (mysqli_query($connection, $sql)) {
		$sql1 = "UPDATE friends SET is_accepted=1 where user_id = '$f_id' AND friend_id = '$u_id'";
		$stmt = $connection->prepare($sql1);
		$stmt->execute();
		
		$sql="Select * from users where id='$u_id'";
		$stmt1 = $connection->prepare($sql);
		$stmt1->execute();
		$result = $stmt1->get_result();
		$row = $result->fetch_assoc();
		
		$sql2="Select * from users where id='$f_id'";
		$stmt2 = $connection->prepare($sql2);
		$stmt2->execute();
		$result2 = $stmt2->get_result();
		$row2 = $result2->fetch_assoc();
		
		echo json_encode(array("statusCode"=>200,"fname"=>$row['first_name'],"lname"=>$row['last_name'],"ffname"=>$row2['first_name'],"flname"=>$row2['last_name']));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($connection);
?>