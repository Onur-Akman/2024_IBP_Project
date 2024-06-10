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

// Get the guide ID from the form submission
$guideId = $_POST['guideId'];

// Get the updated title, guide, and summary from the form submission
$updatedTitle = $_POST['editTitle'];
$updatedGuide = $_POST['editGuide'];
$updatedSummary = $_POST['editSummary'];

// Prepare and execute the UPDATE statement
$stmt = $connection->prepare("UPDATE guides SET title = ?, guide = ?, summary = ? WHERE id = ?");
$stmt->bind_param("sssi", $updatedTitle, $updatedGuide, $updatedSummary, $guideId);
$stmt->execute();

// Close the prepared statement and database connection
$stmt->close();
$connection->close();

// Redirect back to the guide list page
header("Location: ../view_guide.php");
exit();
?>
