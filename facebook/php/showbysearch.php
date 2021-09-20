<?php
include "connection.php";
$key = $_GET["key"];
$u_id = $_GET["u_id"];
$query = "SELECT *
FROM users
WHERE (first_name LIKE '$key%' OR last_name LIKE '$key%') AND id <> $u_id";
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
