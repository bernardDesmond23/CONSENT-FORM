<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consent Report</title>
    <style>
        table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
        }
        th, td {
            background-color: #96D4D4;
            padding: 50px;
        }
    </style>
</head>
<body>
    <?php
    include "connectDB.php";

    $event = "";
    $event_date = "";

    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['event'])) {
                $event = $_POST['event'];
    
                // Fetch event details
                $sql = "SELECT event_id, date FROM event WHERE event_name = $1";
                $result = pg_query_params($connect, $sql, [$event]);
    
                if ($result && pg_num_rows($result) > 0) {
                    $events = pg_fetch_assoc($result);
                    $eventID = $events['event_id'];
                    $event_date = $events['date'];
    
                    // Fetch participant details
                    $sqlresult = "SELECT part_id,first_name, last_name, email, check_field, signature FROM participants WHERE event_type = $1";
                    $result2 = pg_query_params($connect, $sqlresult, [$eventID]);
    
                    if (!$result2) {
                        die("Error fetching participants: " . pg_last_error($connect));
                    }
                } else {
                    echo "<p>No event found with the name '$event'.</p>";
                }
            } else {
                echo "<p>Event name not provided.</p>";
            }
        }
    
    ?>

    <h1>Event: <?= htmlspecialchars($event) ?></h1>
    <h1>Date: <?= htmlspecialchars($event_date) ?></h1>
    <p>THESE ARE THE PEOPLE THAT SIGNED THE CONSENT FORM OF THE ABOVE-MENTIONED EVENT</p>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Consent</th>
            <th>Signature</th>
        </tr>
        <?php
        if (isset($result2) && pg_num_rows($result2) > 0) {
            while ($parts = pg_fetch_assoc($result2)) {
                $first = htmlspecialchars($parts['first_name']);
                $last = htmlspecialchars($parts['last_name']);
                $email = htmlspecialchars($parts['email']);
                $check = htmlspecialchars($parts['check_field']);
                $sign =$parts['signature'] ; 
               

               /* if (base64_decode($sign, true) === false) {
                    $imgSrc = "Invalid Base64 data";
                } else {
                    $imgSrc = "data:image/png;base64,$sign" . htmlspecialchars($sign);
                }*/
        


                echo "
                <tr>
                    <td>$first</td>
                    <td>$last</td>
                    <td>$email</td>
                    <td>$check</td>
                    <td> <img src='$sign' alt='Signature'/></td>
                </tr>";
            }
        }
        ?>
    </table>
</body>
</html>
