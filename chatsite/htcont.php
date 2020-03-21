<?php

$room = $_POST['room'];
include 'db_connect.php';
$sql = "SELECT Message,MessageTime,IP FROM messages WHERE Room = '$room'";
$res = "";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $res = $res . '<div class="container">';
        $res = $res . $row['IP'];
        $res = $res . " says <p>".$row['Message'];
        $res = $res . '</p> <span class="time-right">' . $row['MessageTime'] . '</span></div>';
    }
}

echo $res;

?>