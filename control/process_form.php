<?php
// Include your database connection
include '../db/db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $name = $_POST['itemCode'];
    $phone_number = $_POST['itemName'];
    
    // File upload handling
    $target_dir = "../uploads/"; // Specify where to store the uploaded image
    
    // Check if the upload directory exists, if not, create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($_FILES["itemPhoto"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate the file upload
    if (move_uploaded_file($_FILES["itemPhoto"]["tmp_name"], $target_file)) {
        // Insert the data into the database
        $sql = "INSERT INTO users (name, phone_number, photo) VALUES ('$name', '$phone_number', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // Redirect back to the users page
            header("Location: ../pages/DataUser.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display file upload error
        echo "Sorry, there was an error uploading your file. ";
        var_dump($_FILES["itemPhoto"]["error"]); // Additional error information
    }
}

// Close the connection
$conn->close();
