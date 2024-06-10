<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet" />

    <title>Akman Tourism</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/owl.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        /* Custom styles for this template */

        .btn {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }

        .page-context {
            padding: 60px 0;
            background-color: #f5f5f5;
            text-align: center;
        }

        .page-context h2 {
            margin-bottom: 30px;
            font-size: 36px;
            font-weight: 700;
            color: #000;
        }

        .sidebar-item {
            padding: 40px;
            background-color: #fff;
            border-radius: 5px;
        }

        .sidebar-item h2 {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 700;
            color: #000;
        }

        .sidebar-item form {
            margin-bottom: 0;
        }

        .sidebar-item form input[type="text"],
        .sidebar-item form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .sidebar-item form textarea {
            resize: none;
            height: 120px;
        }

        .sidebar-item form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-information table {
            width: 100%;
        }

        .contact-information th,
        .contact-information td {
            padding: 10px;
            text-align: left;
            border: none;
        }

        .contact-information th {
            font-weight: 700;
        }

        .contact-information tr:hover {
            background-color: transparent;
        }

        .contact-information .btn {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Load ***** -->
    <div id="header-container">
        <?php include "header.php"; ?>
    </div>


    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Message Us</h4>
                            <h2>Have questions? Ask us!</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Banner Ends Here -->

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

    // Fetch the message information from the database
    $query = "SELECT DISTINCT subject FROM message WHERE name = '$username'";
    $result = $connection->query($query);
    ?>

    <!-- Page Content -->
    <div class="page-context">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="sidebar-item contact-form">
                        <div class="sidebar-heading">
                            <h2>Send us a message</h2>
                        </div>
                        <div class="content">
                            <form id="contact" action="../../determination/store_message.php" method="post">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <input type="hidden" name="formUsername" id="formUsername" value="<?php echo $_SESSION['username']; ?>">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <input name="subject" type="text" id="subject" placeholder="Subject">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea name="message" rows="6" id="message" placeholder="Your Message" required=""></textarea>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" id="form-submit" class="main-button">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-item contact-information">
                        <h2>Message Subjects</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['subject']; ?></td>
                                        <td>
                                            <button class="btn btn-primary open-modal-btn" data-toggle="modal" data-target="#conversationModal" data-subject="<?php echo $row['subject']; ?>">Open</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer style="background-color: #000; color: #fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="social-icons">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Youtube</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Linkedin</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <p>Copyright © 2024 Akman Tourism</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Form Modal -->
    <div class="modal fade" id="conversationModal" tabindex="-1" role="dialog" aria-labelledby="conversationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="conversationModalLabel">View Conversation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="conversationContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Handle button click event
            $('.open-modal-btn').click(function() {
                // Get the subject value from the clicked row
                var subject = $(this).data('subject');

                // Set the subject value in the hidden input field
                $('#subjectInput').val(subject);

                // Set the subject value as the modal's title
                $('#conversationModalLabel').text(subject);

                // Load the conversation content via AJAX
                $.ajax({
                    url: 'conversation.php',
                    type: 'GET',
                    data: {
                        subject: subject
                    },
                    success: function(response) {
                        // Update the conversation content inside the modal
                        $('#conversationContent').html(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                        console.log(error);
                    }
                });

                // Open the modal
                $('#conversationModal').modal('show');
            });
        });
    </script>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script>
        $(function() {
            $("#header-container").load("header.php");
        });
    </script>


    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>
</body>

</html>