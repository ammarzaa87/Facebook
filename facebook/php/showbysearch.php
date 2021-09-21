<?php
include "connection.php";
$key = $_GET["key"];
$u_id = $_GET["u_id"];
$query = "SELECT *
FROM users AS u
WHERE (u.first_name LIKE '$key%' OR u.last_name LIKE '$key%') AND u.id <> '$u_id' AND
u.id NOT IN (SELECT u.id FROM users as u,blocks as b WHERE b.blocker_id='$u_id' AND b.blocked_id=u.id)
AND u.id NOT IN (SELECT u.id FROM users as u,friends as f WHERE f.user_id='$u_id' AND f.friend_id=u.id)";
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
