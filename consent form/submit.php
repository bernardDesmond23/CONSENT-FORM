<?php
include "connectDB.php";
session_start();

$event=$_SESSION['event_name'];

$user=$_SESSION['user_id'];
if ($event) {
unset($_SESSION['event_name']);

$sql="UPDATE event SET status='Submitted' WHERE creator_id=$user";
$result=pg_query($connect,$sql);
if($result){
    header("location:home.php");
}
else {
    die(pg_last_error());
}
}
else {
    echo"FAILED TO SUBMIT";
}
?>