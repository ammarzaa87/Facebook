<?php
include "connection.php";
$u_id = $_GET["u_id"];

$query = "SELECT U.id, U.first_name,U.last_name,U.gender
FROM users AS U, blocks AS B
WHERE B.blocker_id='$u_id' AND B.blocked_id=U.id";
$stmt = $connection->prepare($query);
//$stmt->bind_param("ss",$key,$key);
$stmt->execute();
$result = $stmt->get_result();
$temp_array = [];
while($row = $result->fetch_assoc()){
    $temp_array[] = $row;
}

//print_r($temp_array);


$json = json_encode($temp_array, JSON_PRETTY_PRINT);
echo $json;
