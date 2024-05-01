<?php
    $dsn = 'mysql:host=localhost;dbname=praytime';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // If there's an error in database connection, send email
        $errorMessage = "Error connecting to database: " . $e->getMessage();
}
