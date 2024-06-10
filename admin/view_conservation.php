<?php
session_start();

// Check if the admin session variable is not set or is false
if (!isset($_SESSION["adminLoggedIn"]) || $_SESSION["adminLoggedIn"] !== true) {
    // Redirect the user to the admin login page
    header("Location: ../admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Akman Tourism Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Chat-style UI for the modal */
        .chat-modal-body {
            max-height: 400px;
            overflow-y: auto;
        }

        .chat-message {
            margin-bottom: 15px;
        }

        .chat-message .message-sender {
            font-weight: bold;
        }

        .chat-message .message-text {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <?php
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

    // Get the user's username
    $username = $_SESSION["username"];

    // Get the subject from the URL parameter
    $subject = $_GET["subject"];

    // Fetch the message conversation from the database
    $query = "SELECT * FROM message WHERE subject = '$subject' AND (is_admin_reply = 1 OR (is_admin_reply = 0 AND name = (SELECT DISTINCT name FROM message WHERE subject = '$subject' AND is_admin_reply = 0 ORDER BY timestamp ASC LIMIT 1))) ORDER BY timestamp ASC";

    $result = $connection->query($query);
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">View Conversation</h1>

                    <!-- Conversation -->
                    <div class="card shadow mb-4">
                        <div class="card-body chat-modal-body">
                            <?php
                            // Iterate over the messages and generate the conversation
                            while ($row = $result->fetch_assoc()) {
                                $sender = $row['name'];
                                $message = $row['message'];
                                $is_admin_reply = $row['is_admin_reply'];
                            ?>
                                <div class="chat-message">
                                    <?php if ($is_admin_reply == 1) { ?>
                                        <span class="message-sender">Admin:</span>
                                    <?php } else { ?>
                                        <span class="message-sender"><?php echo $sender; ?>:</span>
                                    <?php } ?>
                                    <p class="message-text"><?php echo $message; ?></p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Reply Form -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="/ws/admin/php/submit_answer.php" method="POST">
                                <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                                <div class="form-group">
                                    <textarea class="form-control" name="reply" rows="3" placeholder="Type your message here"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <span>Akman Tourism &copy; 2024</span>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
