<?php
// Check if the user ID is provided
if (isset($_GET['id'])) {
    // Retrieve the user ID from the query string
    $id = $_GET['id'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "2MbpkT[)ZQPej[T~";
    $dbname = "ws";

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare and execute the SQL query to delete the user
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // Close the database connection
    $conn = null;

    // Redirect back to the view_users.php page after deletion
    header("Location: ../view_users.php");
    exit();
} else {
    // Redirect to the view_users.php page if the user ID is not provided
    header("Location: ../view_users.php");
    exit();
}
?>
