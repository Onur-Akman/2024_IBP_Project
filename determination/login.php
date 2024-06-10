<?php
session_start();

// Include the connection.php file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Your database query to check user credentials
    $query = "SELECT * FROM users WHERE email = ? AND password = ?";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bind_param("ss", $email, $password);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, login successful
        $row = $result->fetch_assoc();
        $_SESSION["email"] = $email;
        $_SESSION["loggedIn"] = true;
        $_SESSION["username"] = $row["username"]; // Added line to store the username in session

        // Check if the user is admin
        if ($email === "admin@admin.com" && $password === "admin") {
            $_SESSION["adminLoggedIn"] = true;
            $_SESSION["adminName"] = "Admin";
            header("Location: ../admin/index.php?login=success");
        } else {
            header("Location: ../pages/landing/index.php?login=success");
        }
        exit;
    } else {
        // User does not exist or invalid credentials
        $errorMessage = "Invalid email or password";
        $_SESSION["errorMessage"] = $errorMessage;
        header("Location: ../pages/page.php?login=failed");
        exit;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
} else {
    // Redirect or display an error message, as the form is not submitted
    header("Location: ../pages/error.php");
    exit;
}
?>
