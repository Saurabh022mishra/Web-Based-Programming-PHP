<?php
echo "Enter sender email: ";
$senderEmail = trim(fgets(STDIN));
echo "Enter receiver email: ";
$to = trim(fgets(STDIN));   
echo "Enter subject: ";
$subject = trim(fgets(STDIN));
echo "Enter message: ";
$message = trim(fgets(STDIN));
$headers = "From: " . $senderEmail;

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed.";
}

?>