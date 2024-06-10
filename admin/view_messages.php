<?php
session_start();

// Check if the admin session variable is not set or is false
if (!isset($_SESSION["adminLoggedIn"]) || $_SESSION["adminLoggedIn"] !== true) {
    // Redirect the user to the admin login page
    header("Location: ../admin_login.php");
    exit;
}

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

// Fetch unique subjects and corresponding user names from the database
$sql = "SELECT subject, name FROM message GROUP BY subject";
$result = $connection->query($sql);
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


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
    <!-- Page Wrapper -->
    <div id="wrapper">
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
                    <h1 class="h3 mb-2 text-gray-800">View Messages</h1>

                    <!-- Data Table -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Iterate over the subjects and generate the table rows
                                        while ($row = $result->fetch_assoc()) {
                                            $name = $row['name'];
                                            $subject = $row['subject'];
                                        ?>
                                            <tr>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $subject; ?></td>
                                                <td>
                                                    <a href="view_conversation.php?subject=<?php echo urlencode($subject); ?>&name=<?php echo urlencode($name); ?>" class="btn btn-primary">Open</a>
                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-<?php echo urlencode($subject); ?>" data-message-subject="<?php echo $subject; ?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
        <?php
        // Fetch all messages again to generate delete modals for each subject
        $allMessages = $connection->query("SELECT * FROM message");
        while ($message = $allMessages->fetch_assoc()) {
            $messageSubject = $message['subject'];
        ?>
            <!-- Delete Message Modal -->
            <div class="modal fade" id="deleteModal-<?php echo $messageSubject; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete all messages with the subject "<?php echo $messageSubject; ?>"?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger delete-message-btn" data-dismiss="modal" data-message-subject="<?php echo $messageSubject; ?>">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
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

    <script>
        $(document).ready(function() {
            // Show the delete message modal
            $('.btn.btn-danger').click(function() {
                var targetModal = $(this).attr('data-target');
                $(targetModal).modal('show');
            });


            // Handle the delete button click inside the delete message modal
            $('.delete-message-btn').click(function() {
                var messageSubject = $(this).data('message-subject');
                // Perform the delete operation using AJAX or redirect to the delete script
                window.location.href = 'php/delete_message.php?subject=' + encodeURIComponent(messageSubject);
            });
        });
    </script>

</body>

</html>

<?php
// Close the database connection
$connection->close();
?>