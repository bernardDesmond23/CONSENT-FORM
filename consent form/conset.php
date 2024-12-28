<?php
include "connectDB.php";

session_start();
$event=$_SESSION['event_name'];
$signatureImage=$_SESSION['signature'] ;
if(isset($event)){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $firstName=$_POST['fname'];
        $lastName=$_POST['lastname'];
        $email=$_POST['email'];
       $checkbox=$_POST['checkbox'];
        $signature=$_POST['signaturespace'];
        if(empty($signature)){
            die("The signature isnt present");
        }
        //$base64_signimage=base64_decode($signature);
      $idsql="SELECT event_id FROM event  where event_name='$event'";
      $sqlresult=pg_query($connect,$idsql);
      if (pg_num_rows($sqlresult)>0) {
        $account=pg_fetch_assoc($sqlresult);
        $eventID= $account['event_id'];
      }
    
        $sql= "INSERT INTO participants (first_name,last_name,email,check_field,signature,event_type) 
        VALUES ('$firstName','$lastName','$email','$checkbox','$signature',$eventID)";
        $result= pg_query($connect,$sql);
        if ($result) {
            echo"THANK YOU FOR SIGNING THE FORM";
           unset($_SESSION['signature']);
            header("location:home.php");
        }
        else {
            die(pg_last_error($connect));
        }
    
    
    }
    else{
        echo"";
    }
}
else{
    header("location:404.html");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONSENT FORM</title>
    <link rel="stylesheet" href="consent.css">
</head>
<body>
    <div id = "content">
        <h1><?php echo $event ?></h1>
        <p>Incase you dont want for you to appear in any our socials please sign the form below </p>
    </div>
    <div id="form"> 
        <form  method="POST">
            <h1 id="headinglabel">CONSENT FORM</h1>
            
                <label for="fname"  class="labels">First name</label><br> 
                <input type="text" id="firname" name="fname"><br> 
          
            
            <label  class="labels">Last Name</label><br> 
            <input type="text" id="lasname" name="lastname"><br> 
            <label class="labels">Email</label><br> 
            <input type="email" id="email" name="email"><br> 
            <input type="radio" id="checkYes" value="Yes" name="checkbox">
            <label>Yes</label>
            <input type="radio" id="checkNo" value="No" name="checkbox"> 
            <label>No</label><br> 
            <label class="labels">Signature</label><br> 
            <input type="button" value="GET SIGNATURE" onclick="window.location.href='index.html'"><br><br>
            <div id="signaturespace" >
       <?php if ($signatureImage): ?>
                    <img src="<?= htmlspecialchars($signatureImage) ?>" alt="Signature">
                    <input type="hidden" name="signaturespace" value="<?= htmlspecialchars($signatureImage) ?>">
                <?php endif; ?>
            </div><br>
            <input type="Submit" value="SUBMIT">
        </form>
    </div>
    
</body>
</html>