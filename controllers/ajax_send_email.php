<?php
require "functions.php";
$to = $_POST['to'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if (sendEmail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} else {
    echo 'Failed to send email.';
}

?>