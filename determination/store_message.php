<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
    // Redirect them to the login page or display an error message
    header("Location: ../pages/page.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $formUsername = $_POST["formUsername"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Database connection parameters
    $servername = "localhost";
    $dbUsername = "root";
    $password = "2MbpkT[)ZQPej[T~";
    $dbname = "ws";

    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbUsername, $password);

        // Prepare and execute the SQL query to insert the message into the table
        $stmt = $conn->prepare("INSERT INTO message (`name`, subject, message) VALUES (:name, :subject, :message)");
        $stmt->bindParam(':name', $formUsername);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        $stmt->execute();

        // Close the database connection
        $conn = null;

        // Redirect or display a success message
        // You can customize this based on your requirements
        header("Location: ../pages/landing/messages.php");
        exit();
    } catch (PDOException $e) {
        // Handle the exception here or display an error message
        echo "Error: " . $e->getMessage();
    }
}
?>
