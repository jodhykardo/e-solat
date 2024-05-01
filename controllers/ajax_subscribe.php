<?php
    require "conn.php";

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get user ID and box ID from the AJAX request
        $userId = $_POST['userId'];
        $boxId = $_POST['boxId'];

        // Insert the subscription into subsBox table
        $stmt = $db->prepare("INSERT INTO subsBox (subsId, boxId) VALUES (:subs_id, :box_id)");
        $stmt->bindParam(':box_id', $boxId);
        $stmt->bindParam(':subs_id', $userId);
        $stmt->execute();

        echo "Subscription successful!";
    } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        $userId = $_GET['user_id'];
        $boxId = $_GET['box_id'];

        $stmt = $db->prepare("DELETE FROM subsBox WHERE subsID=:subs_id AND boxId=:box_id");
        $stmt->bindParam(':box_id', $boxId);
        $stmt->bindParam(':subs_id', $userId);
        $stmt->execute();

        echo "Subscription successfully deleted!";
    } else {
        // If the request method is not POST, handle the error
        http_response_code(405); // Method Not Allowed
        echo "Invalid request method!";
    } 
    
    
?>
