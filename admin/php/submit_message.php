<?php
session_start();

// Check if the user session variable is not set or is false
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
    // Redirect the user to the login page
    header("Location: ../login.php");
    exit;
}

// Retrieve the submitted message data
$subject = $_POST["subject"];
$message = $_POST["message"];
$sender = $_SESSION["username"];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "2MbpkT[)ZQPej[T~";
$dbname = "ws";

// Create a new mysqli instance
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare and execute the query to insert the new message
$query = "INSERT INTO message (name, subject, message, is_admin_reply) VALUES ('$sender', '$subject', '$message', 0)";
$result = $connection->query($query);

// Check if the query was successful
if ($result === true) {
    // Redirect the user back to the conversation page
    header("Location: ../conversation.php?subject=" . urlencode($subject));
    exit;
} else {
    // Display an error message
    echo "Error: " . $connection->error;
}

// Close the database connection
$connection->close();
?>