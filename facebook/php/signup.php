<?php
include "connection.php";

if(isset($_POST["first_name"]) && $_POST["first_name"] != "" && strlen($_POST["first_name"]) >= 3) {
    $first_name = $_POST["first_name"];
}else{
    die ("a Enter a valid input");
}

if(isset($_POST["last_name"]) && $_POST["last_name"] != "" && strlen($_POST["last_name"]) >= 3) {
    $last_name = $_POST["last_name"];
}else{
    die ("b Enter a valid input");
}


if(isset($_POST["email"]) && $_POST["email"] != "" ) {
    $email = $_POST["email"];
}else{
    die ("c Enter a valid input");
}
if(isset($_POST["gender"]) && $_POST["gender"] != "" ) {
    $gender = $_POST["gender"];
}else{
    die ("d Enter a valid input");
}


if(isset($_POST["password"]) && $_POST["password"] != "" ) {
    $password = $_POST["password"];
}else{
    die ("e Enter a valid input");
}

if(isset($_POST["confirmPassword"]) && $_POST["confirmPassword"] != "" ) {
    $confirmPassword = $_POST["confirmPassword"];
}else{
    die ("f Enter a valid input");
}
if(isset($_POST["date"]) && $_POST["date"] != "" ) {
    $date = $_POST["date"];
}else{
    die ("e Enter a valid input");
}


$sql1="Select * from users where email=?"; #Check if the email already exists in the database
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s",$email);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();

if(empty($row)){
$query = "INSERT INTO addresses(city, region, country) VALUES ('', '', '')";
$obj = $connection->prepare($query);
//$obj->bind_param("sss","y","u","y");
$obj->execute();
$add_id = $obj->insert_id;

$sql2 = "INSERT INTO `users` (`first_name`, `last_name`,`gender`,`birth`,`email`, `password`,`address_id`) VALUES (?, ?, ?, ?, ?,?,?);"; #add the new user to the database
$hash = hash('sha256', $password);
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("sssssss",$first_name,$last_name,$gender,$date,$email,$hash,$add_id);
$stmt2->execute();
$result2 = $stmt2->get_result();

$sql3="Select * from users where email=? and password=?"; #to get the id of user
$stmt3 = $connection->prepare($sql3);
$stmt3->bind_param("ss",$email,$hash);
$stmt3->execute();
$result3 = $stmt3->get_result();
$row3 = $result3->fetch_assoc();
session_start();
$_SESSION["flash"] = "";
$_SESSION["u_id"] = $row3['id'];
header('location: ../index.php');


}
else{
    session_start();
    $_SESSION["flash"] = "This email is taken, please register with new one";
    header('location: ../sign-up.php');
}
?>