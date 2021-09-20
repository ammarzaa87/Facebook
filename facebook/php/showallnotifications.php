<?php
include "connection.php";
$u_id = $_GET["u_id"];

$query = "SELECT *
FROM notifications 
WHERE user_id=? ORDER BY id DESC";
$stmt = $connection->prepare($query);
$stmt->bind_param("s",$u_id);
$stmt->execute();
$result = $stmt->get_result();
$temp_array = [];
while($row = $result->fetch_assoc()){
    $temp_array[] = $row;
}


$json = json_encode($temp_array, JSON_PRETTY_PRINT);
echo $json;
