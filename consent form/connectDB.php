<?php
$server='localhost';
$port="5432";
$user='postgres';
$password='postdb';
$database='ConsentForm';

$connection_string="host=$server port=$port  user=$user password=$password dbname=$database";
$connect=pg_connect($connection_string);
if ($connect) {
    echo"Connected to DB successfully";
}
else {
  echo"An error occured";
}
   
?>