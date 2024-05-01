<?php

require 'conn.php';
require 'constant.php';
require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $name = sanitizeInput($_POST['name']);
    $confirmPassword = sanitizeInput($_POST['confirm_password']);

    // Check if $username is a valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        echo "<script>window.location.href = 'register.php';</script>";
        exit;
    } 
    // Check if password and confirm password match
    else if ($password !== $confirmPassword) {
        echo "<script>alert('Password and confirm password do not match.');</script>";
        echo "<script>window.location.href = 'register.php';</script>";
        exit;
    }
    // Check if password character more than 6 characters
    else if (strlen($confirmPassword) <6) {
        echo "<script>alert('Password need at least 6 characters');</script>";
        echo "<script>window.location.href = 'register.php';</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare and execute SQL statement to insert user into the database
        $stmt = $db->prepare("INSERT INTO subscriber (subsEmail, subsName, subsPassword, subsJoinDate) VALUES (:email, :name, :password, :time)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':time', $currentDateTime);
        $stmt->execute();

        // Registration successful, set session and redirect
        session_start(); // Start the session
        $_SESSION['username'] = $name; // Save email in session
        $_SESSION['user_id'] = $db->lastInsertId();
        header("Location: ../index.php"); // Redirect to index.php
        exit(); // Make sure to exit after redirect
    } catch (PDOException $e) {
        // Handle database error
        echo "Error: " . $e->getMessage();
    }
}
?>