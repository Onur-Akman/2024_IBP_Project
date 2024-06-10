<?php
// Check if the tour ID is provided
if (isset($_GET['id'])) {
    $tourId = $_GET['id'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "2MbpkT[)ZQPej[T~";
    $dbname = "ws";

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare and execute the SQL query to delete the tour
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->bindParam(":id", $tourId);
    $stmt->execute();

    // Close the database connection
    $conn = null;

    // Redirect back to the view tours page
    header("Location: ../view_tour.php");
    exit();
}
?>
