<?php
	include 'connection.php';
	$u_id=$_POST['u_id'];
	$f_id=$_POST['f_id'];
	$sql = "delete from `friends`where user_id = '$u_id' AND friend_id = '$f_id'";
	
	

	if (mysqli_query($connection, $sql)) {
		$sql1 = "delete from `friends` where user_id = '$f_id' AND friend_id = '$u_id'";
		$stmt = $connection->prepare($sql1);
		$stmt->execute();
		
		$sql2="Select * from users where id='$f_id'";
		$stmt2 = $connection->prepare($sql2);
		$stmt2->execute();
		$result2 = $stmt2->get_result();
		$row2 = $result2->fetch_assoc();
		
		echo json_encode(array("statusCode"=>200,"ffname"=>$row2['first_name'],"flname"=>$row2['last_name']));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($connection);
?>