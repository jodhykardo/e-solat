<?php

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// send email
function sendEmail($to, $subject, $message, $headers = []) {
    // Additional headers
    $headers[] = 'From: Jodi Kardo <jodhykardo@gmail.com>';
    $headers[] = 'Reply-To: Jodi Kardo <jodhykardo@gmail.com>';
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    // Make sure the subject is encoded properly
    $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

    // Send email
    return mail($to, $subject, $message, implode("\r\n", $headers));
}
?>