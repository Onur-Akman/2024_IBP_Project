<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $guide = $_POST["guide"];
    $published_date = $_POST["published_date"];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "2MbpkT[)ZQPej[T~";
    $dbname = "ws";

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare and execute the SQL query to insert the data
    $stmt = $conn->prepare("INSERT INTO guides (title, summary, guide, published_date) VALUES (:title, :summary, :guide, :published_date)");
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":summary", $summary);
    $stmt->bindParam(":guide", $guide);
    $stmt->bindParam(":published_date", $published_date);
    $stmt->execute();

    // Close the database connection
    $conn = null;

    echo "Guide submitted successfully!";
    exit();
}
?>
