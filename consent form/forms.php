<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>HOME PAGE</title>
    <style>
        table, th, td {
    border: 1px solid white;
    border-collapse: collapse;
  }
  th, td {
    background-color: #96D4D4;
    padding:50px;
  }
    </style>
</head>
<body>
    <div id="nav-bar">
        <ul>
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="create.html">Create</a></li>
            <li><a href="forms.php">ConsentForms</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <br>
    <table>
        <tr>
        
            <td>Event</td>
           
            <td> Conset Form</td>
            <td>Submit</td>
            
        </tr>
        <?php
include "connectDB.php";
session_start();
$event=$_SESSION['event_name'];



if ($event) {
   
        
        echo"
         <tr>
               
                    <td>$event</td>
                    
                    <td><button><a href='conset.php'>VIEW</a></button></td>
                    <td> <button><a href='submit.php'>SUBMIT</a></button></td>
                </tr>
        ";
    }
  else {
    "CAN`T DISPLAY EVENT CREATED";
  }
 


        ?>
    </table>
    
</body>
</html>