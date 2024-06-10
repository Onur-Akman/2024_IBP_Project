<?php
session_start();

// Include the connection.php file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];

    // Your database query
    $query = "INSERT INTO users (email, password, username) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bind_param("sss", $email, $password, $username);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful!";
    } else {
        // Error occurred
        echo "Error: " . $conn->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
    header("Location: ../pages/page.php?success=true");
}
?>
