<?php

//Connecting to the database
include 'db_connect.php';

$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];

$sql = "INSERT INTO `messages` ( `Message`, `Room`, `IP`, `MessageTime`) VALUES ('$msg', '$room', '$ip', current_timestamp());"; 
mysqli_query($conn,$sql);
mysqli_close($conn);
?>