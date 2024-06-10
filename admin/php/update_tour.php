<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $id = $_POST["tourId"];
    $title = $_POST["editTitle"];
    $season = $_POST["editSeason"];
    $night = $_POST["editNight"];
    $responsible = $_POST["editResponsible"];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "2MbpkT[)ZQPej[T~";
    $dbname = "ws";

    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare and execute the SQL query to update the tour
    $stmt = $conn->prepare("UPDATE posts SET title = :title, season = :season, night = :night, responsible = :responsible WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":season", $season);
    $stmt->bindParam(":night", $night);
    $stmt->bindParam(":responsible", $responsible);
    $stmt->execute();

    // Close the database connection
    $conn = null;

    header("Location: ../view_tour.php");
    exit();
}
?>
