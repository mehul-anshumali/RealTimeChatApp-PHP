<?php

$roomname = $_GET['roomname'];

//Connecting to the database
include 'db_connect.php';

//Room exists or not
$sql = "SELECT * FROM `rooms` WHERE RoomName = '$roomname' ";

$result = mysqli_query($conn , $sql);
if($result){

    if(mysqli_num_rows($result) ==0){

        $message = "This room does not exists , Please create another room  ";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatsite/";';
        echo '</script>';  
    }
   
}

else {
     echo 'ERROR :' .mysqli_error($conn);
}



?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.scroll{
    height:350px;
    overflow-y:scroll;
}
</style>
</head>
<body>
    

<h2>Chat - <?php echo $roomname; ?> </h2>

<div class="container">
    <div class="scroll"> 

  </div>

</div>


<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add Message..."><br>
<button type="submit" class="btn btn-outline-primary" id="submitmsg">Send</button>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		
<script type="text/javascript">
//Check new messgaes 
setInterval(runFunction,1000);
function runFunction(){
    $.post("htcont.php",{room: '<?php echo $roomname ?>'},
    function(data,status){
        document.getElementsByClassName('scroll')[0].innerHTML = data;
    })
}




    // Using enter key t sumbit form
var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("submitmsg").click();
  }
}); 
    //when user submit form
    
    $("#submitmsg").click(function(){
        var clientmsg = $('#usermsg').val();
    $.post("postmsg.php", {text: clientmsg , room: '<?php echo $roomname ?>' , ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
    function(data,status){
        document.getElementsByClassName('scroll')[0].innerHTML = data;});
        $('#usermsg').val("");
    return false;
    
});
</script>


</body>
</html>
