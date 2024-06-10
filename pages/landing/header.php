<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
  // Redirect them to the login page or display an error message
  header("Location: ../pages/page.php");
  exit;
}

// Check if the "username" key is set in the $_SESSION array
if (!isset($_SESSION["username"])) {
  // Redirect or display an error message, as the username is not available
  header("Location: ../pages/error.php");
  exit;
}

// Now the user is logged in and the "username" key is set
$username = $_SESSION["username"];

// Retrieve additional user information from the database if needed

// Display user information or perform other actions
echo "Welcome, " . $username;
?>


<!-- Header -->
<header class="">
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <h2>Akman Tourism<em>.</em></h2>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
        aria-controls="navbarResponsive"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="tour.php">Tours</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="guide.php">Guides</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              data-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
              >About</a
            >
            <div class="dropdown-menu">
              <a class="dropdown-item" href="about.html">About Us</a>
              <a class="dropdown-item" href="expert.html">Experts</a>
              <a class="dropdown-item" href="faqs.html">FAQs</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              data-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
              >Profile</a
            >
            <div class="dropdown-menu">
              <a class="dropdown-item" href="messages.php">Messages</a>
              <a
                class="dropdown-item"
                href="#"
                data-toggle="modal"
                data-target="#changePasswordModal"
                >Change Password</a
              >
              <a
                class="dropdown-item"
                href="#"
                data-toggle="modal"
                data-target="#logoutModal"
                >Log Out</a
              >
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- Change Password Modal -->
<div
  class="modal fade"
  id="changePasswordModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="changePasswordModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">
          Change Password
        </h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../../determination/change_password.php" method="post">
          <div class="form-group">
            <label for="currentPassword">Current Password</label>
            <input
              type="password"
              class="form-control"
              id="currentPassword"
              name="currentPassword"
              placeholder="Enter current password"
              required
            />
          </div>
          <div class="form-group">
            <label for="newPassword">New Password</label>
            <input
              type="password"
              class="form-control"
              id="newPassword"
              name="newPassword"
              placeholder="Enter new password"
              required
            />
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input
              type="password"
              class="form-control"
              id="confirmPassword"
              name="confirmPassword"
              placeholder="Confirm new password"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Logout Modal -->
<div
  class="modal fade"
  id="logoutModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="logoutModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Log Out</h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to log out?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Cancel
        </button>
        <a class="btn btn-primary" href="../page.php">Log Out</a>
      </div>
    </div>
  </div>
</div>
