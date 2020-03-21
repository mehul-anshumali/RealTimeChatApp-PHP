<?php

//getting room name
$room = $_POST['room'];

//Checking room name is valid or not
if(strlen($room)>10 or strlen($room)<2){
    $message = "Please enter the name of a room between 2 to 20 characters";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatsite/";';
    echo '</script>';   
}

else if (!ctype_alnum($room)){
    $message = "Please enter valid name of a room";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatsite/";';
    echo '</script>';   
    
}


//Connecting to the database
else{
    include 'db_connect.php';

}


//Checking room exists or not 
$sql = "SELECT * FROM `rooms` WHERE RoomName = '$room' ";
$result = mysqli_query($conn , $sql);
if($result){
    if(mysqli_num_rows($result) > 0){
        $message = "This room name already exists , Please choose another room name ";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatsite/";';
        echo '</script>';  
    }
    else{
        $sql = "INSERT INTO `rooms` (`RoomName`, `CreationTime`) VALUES ('$room', current_timestamp()); ";
        if(mysqli_query($conn,$sql)){
            $message = "Your room is created..";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/chatsite/roomlist.php?roomname=' .$room. '";';
            echo '</script>';

        }
    }
}
else{
    echo 'ERROR :' .mysqli_error($conn);
}




?>