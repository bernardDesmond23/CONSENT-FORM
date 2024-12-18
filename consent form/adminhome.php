



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
            <li><a href="adminhome.php">Dashboard</a></li>
            <li><a href="search.html">Search Form</a></li>
            
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <br>
    <table>
        <tr>
       
            <td>Event</td>
            <td>Date</td>
            <td>Location</td>
            <td>Status</td>
            <td>Event Creator</td>
            
           
            
        </tr>
        <?php
include "connectDB.php";



$idsql="SELECT * from event";
$sqlresult=pg_query($connect,$idsql);
if ($sqlresult) {

    while($account=pg_fetch_assoc($sqlresult)){
        $event= $account['event_name'];
        $e_date=$account['date'];
        $event_location=$account['location'];
        $status=$account['status'];
        $creator=$account['creator_id'];
        $sql="SELECT fullname from users WHERE user_id=$creator";
        $result=pg_query($connect,$sql);
        if ($result) {
            if(pg_num_rows($result)>0){
                $users=pg_fetch_assoc($result);
                $creator_name=$users['fullname'];
                
            }
        }
        else {
            die(pg_last_error());
        }
        
        echo"
         <tr>
               
                    <td>$event</td>
                    <td>$e_date</td>
                    <td>$event_location</td>
                    <td>$status</td>
                   <td>$creator_name</td>
                   
                </tr>
        ";
    }
  
 
}

        ?>
    </table>
    
</body>
</html>