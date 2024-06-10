<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $season = $_POST["season"];
    $night = $_POST["night"];
    $responsible = $_POST["responsible"];
    $email = $_POST["email"];
    $summary = $_POST["summary"];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "2MbpkT[)ZQPej[T~";
    $dbname = "ws";

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare and execute the SQL query to insert the data
    $stmt = $conn->prepare("INSERT INTO posts (title, season, night, responsible, email, summary) VALUES (:title, :season, :night, :responsible, :email, :summary)");
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":season", $season);
    $stmt->bindParam(":night", $night);
    $stmt->bindParam(":responsible", $responsible);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":summary", $summary);
    $stmt->execute();

    // Close the database connection
    $conn = null;

    echo "Post submitted successfully!";
    exit();
}
?>
