<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION["adminLoggedIn"]) || $_SESSION["adminLoggedIn"] !== true) {
    // Redirect them to the login page or display an error message
    header("Location: ../../pages/page.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $subject = $_POST["subject"];
    $message = $_POST["reply"];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "2MbpkT[)ZQPej[T~";
    $dbname = "ws";

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Prepare and execute the SQL query to insert the admin's reply as a new message
$stmt = $conn->prepare("INSERT INTO message (name, subject, message, is_admin_reply) VALUES (:name, :subject, :message, :is_admin_reply)");
$stmt->bindValue(":name", "Admin");
$stmt->bindValue(":subject", $subject);
$stmt->bindValue(":message", $message);
$stmt->bindValue(":is_admin_reply", true);

$stmt->execute();


    // Close the database connection
    $conn = null;

    // Redirect or display a success message
    // You can customize this based on your requirements
    header("Location: ../view_conversation.php?subject=" . urlencode($subject) . "&name=" . urlencode($name));
    exit();
}
?>
