<?php

require 'conn.php';
require 'constant.php';
require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    $stmt = $db->prepare("SELECT subsId, subsName, subsPassword FROM subscriber WHERE subsEmail=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Fetch the result
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        session_start(); // Start the session
        // Verify the password
        if (password_verify($password, $user['subsPassword'])) {
            // Set session variables or perform other actions
            $_SESSION['username'] = $user['subsName'];
            $_SESSION['user_id'] = $user['subsId'];
            // Redirect user to dashboard or other page
            header("Location: ../index.php");
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password')</script>";
            echo "<script>window.location.href = '../index.php';</script>";
        }
    } else {
        echo "<script>alert('Your username or password is wrong!')</script>";
        echo "<script>window.location.href = '../index.php';</script>";
    }
}
