



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
            <li><a href="#">ConsentForms</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>
    <br>
    <table>
        <tr>
       
            <td>Event</td>
            <td>Date</td>
            <td>Location</td>
            <td>Status</td>
           
            
        </tr>
        <?php
include "connectDB.php";
session_start();
$user=$_SESSION['user_id'];


$idsql="SELECT event_name,date,location, status from event where creator_id='$user'";
$sqlresult=pg_query($connect,$idsql);
if ($sqlresult) {
    while($account=pg_fetch_assoc($sqlresult)){
        $event= $account['event_name'];
        $e_date=$account['date'];
        $event_location=$account['location'];
        $status=$account['status'];
        
        echo"
         <tr>
               
                    <td>$event</td>
                    <td>$e_date</td>
                    <td>$event_location</td>
                    <td>$status</td>
                   
                </tr>
        ";
    }
  
 
}

        ?>
    </table>
    
</body>
</html>