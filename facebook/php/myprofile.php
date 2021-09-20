<?php
include "connection.php";
$u_id = $_GET["u_id"];

$query = "SELECT *
FROM users AS U, addresses AS A
WHERE U.id=? AND U.address_id=A.id";
$stmt = $connection->prepare($query);
$stmt->bind_param("s",$u_id);
$stmt->execute();
$result = $stmt->get_result();
$temp_array = [];
while($row = $result->fetch_assoc()){
    $temp_array[] = $row;
}

//print_r($temp_array);


$json = json_encode($temp_array, JSON_PRETTY_PRINT);
echo $json;
