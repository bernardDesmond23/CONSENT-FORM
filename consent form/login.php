<?php
include "connectDB.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
   $username=$_POST['user'];
    $password=$_POST['pass'];
    
    $sql= "SELECT * FROM users where username='$username'";
    
    $result=pg_query($connect,$sql);
    if($result){
        if(pg_num_rows($result)>0){
            $users=pg_fetch_assoc($result);
            $password_hash=$users['password'];
            if (password_verify($password,$password_hash)) {
            session_start();
            $_SESSION['username']=$username;
            $_SESSION['user_id']=$users['user_id'];
            header("location:home.php");
            }
            else {
            echo"INVALID LOGIN";
            }
        }
    }
    else {
        die(pg_last_error($connect));
    }

   

}
else{
    echo"CAN`T REGISTER INFORMATION";
}
?>