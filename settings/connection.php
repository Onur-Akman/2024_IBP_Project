<?php
$servername = "localhost";
$username = "root";
$password = "2MbpkT[)ZQPej[T~";
$dbname = "ws";//data ismi gerekiyor

// Create a new MySQL database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
