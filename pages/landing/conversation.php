<?php
session_start();

// Check if the user session variable is not set or is false
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
    // Redirect the user to the login page
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    $query = "SELECT * FROM message WHERE subject = '$subject' AND (name = '$username' OR is_admin_reply = 1) ORDER BY timestamp ASC";
    $result = $connection->query($query);

    // Check if the query was successful
    if ($result === false) {
        die("Error executing the query: " . $connection->error);
    }
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

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
                            <form action="/ws/admin/php/submit_message.php" method="POST">
                                <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="3" placeholder="Type your message here"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
