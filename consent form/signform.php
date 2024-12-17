<?php
include "connectDB.php";


if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['fullname'];
    $email=$_POST['emailuser'];
    $username=$_POST['username'];
    $occupation=$_POST['occupation'];
    $number=$_POST['telenumber'];
    $password=$_POST['passwrd'];
    $password_hash=password_hash($password,PASSWORD_DEFAULT);
    $sql= "INSERT INTO users(fullname,email,occupation,phonenumber, password,username) 
    VALUES ('$name','$email','$occupation','$number','$password_hash','$username')";
    $result= pg_query($connect,$sql);
    if ($result) {
      
        echo"SIGNUP SUCCESSFULL";
        header("location:login.html");
    }
    else {
        die(pg_last_error($connect));
    }


}
else{
    echo"CAN`T REGISTER INFORMATION";
}











?>