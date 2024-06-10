<?php
session_start();

// Check if the admin session variable is not set or is false
if (!isset($_SESSION["adminLoggedIn"]) || $_SESSION["adminLoggedIn"] !== true) {
    // Redirect the user to the admin login page
    header("Location: ../admin_login.php");
    exit;
}

// Check if the message subject is provided in the query string
if (isset($_GET['subject'])) {
    // Get the message subject
    $messageSubject = $_GET['subject'];

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

    // Prepare the delete statement
    $deleteQuery = "DELETE FROM message WHERE subject = ?";

    // Prepare and bind the parameters
    $deleteStatement = $connection->prepare($deleteQuery);
    $deleteStatement->bind_param("s", $messageSubject);

    // Execute the delete statement
    if ($deleteStatement->execute()) {
        // Redirect to the view messages page
        header("Location: ../view_messages.php");
        exit;
    } else {
        echo "Error deleting messages: " . $connection->error;
    }

    // Close the prepared statement and the database connection
    $deleteStatement->close();
    $connection->close();
} else {
    echo "Invalid message subject.";
}
?>
