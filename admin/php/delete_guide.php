<?php
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

// Get the guide ID from the URL parameter
$guideId = $_GET['id'];

// Prepare and execute the DELETE statement
$stmt = $connection->prepare("DELETE FROM guides WHERE id = ?");
$stmt->bind_param("i", $guideId);
$stmt->execute();

// Close the prepared statement and database connection
$stmt->close();
$connection->close();

// Redirect back to the guide list page
header("Location: ../view_guide.php");
exit();
?>
