<?php
include "connectDB.php";
session_start();
$userID=$_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $event=$_POST['eventname'];
    $e_date=$_POST['date'];
    $event_location=$_POST['location'];
    $sql= "INSERT INTO event (event_name,date,location,creator_id) VALUES ('$event','$e_date','$event_location','$userID')";
    $result= pg_query($connect,$sql);
    if ($result) {
       
    $_SESSION['event_name']=$event;
    

        echo"EVENT CREATED SUCCESSFULLY";
        header("location:home.php");
    }
    else {
        die(pg_last_error($connect));
    }


}
else{
    echo"CAN`T REGISTER INFORMATION";
}











?>