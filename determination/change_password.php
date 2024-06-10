<?php
session_start();

// Include the connection.php file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the form data
  $currentPassword = $_POST["currentPassword"];
  $newPassword = $_POST["newPassword"];
  $confirmPassword = $_POST["confirmPassword"];

  // Check if the new password and confirm password match
  if ($newPassword !== $confirmPassword) {
    $errorMessage = "New password and confirm password do not match";
    $_SESSION["errorMessage"] = $errorMessage;
    header("Location: ../pages/index.php");
    exit;
  }

  // Retrieve the user's email from the session
  $email = $_SESSION["email"];

  // Retrieve the user's current password from the database
  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedPassword = $row["password"];

    // Verify if the current password matches the stored password
    if ($currentPassword !== $storedPassword) {
      $errorMessage = "Invalid current password";
      $_SESSION["errorMessage"] = $errorMessage;
      header("Location: ../pages/landing/index.php");
      exit;
    }

    // Update the password in the database
    $updateQuery = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";

    if ($conn->query($updateQuery)) {
      $_SESSION["successMessage"] = "Password updated successfully";
      header("Location: ../pages/landing/index.php");
      exit;
    } else {
      $errorMessage = "Error updating password: " . $conn->error;
      $_SESSION["errorMessage"] = $errorMessage;
      header("Location: ../pages/landing/index.php");
      exit;
    }
  } else {
    $errorMessage = "User not found";
    $_SESSION["errorMessage"] = $errorMessage;
    header("Location: ../pages/landing/index.php");
    exit;
  }

  // Close the database connection
  $conn->close();
}
?>
