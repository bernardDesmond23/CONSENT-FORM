<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the raw input data
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['signature'])) {
        // Store the signature in the session or database
        $signatureImage = $data['signature'];
        $_SESSION['signature'] = $signatureImage;
        // Respond with success
        echo $signatureImage; // Return Base64 signature as response
    } else {
        http_response_code(400);
        echo"No signature data received";
       
    }

} 
else {
    http_response_code(405); // Method not allowed
    echo "Invalid request method.";
}
?>
