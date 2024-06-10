<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Akman Tourism Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
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

        // Fetch the tour information from the database
        $query = "SELECT id, title, season, night, responsible FROM posts";
        $result = $connection->query($query);

        ?>

        <!-- Display the tours as a list -->

        <div class="card flex-grow-1">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">View Tours</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Edit</th>
                                <th>Title</th>
                                <th>Season</th>
                                <th>Night</th>
                                <th>Responsible Person</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Iterate over the tour results and generate the list
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $season = $row['season'];
                                $night = $row['night'];
                                $responsiblePerson = $row['responsible'];
                            ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">
                                                <i class="fas fa-edit mr-1"></i> Change
                                            </a>
                                            <a href="#" class="ml-2 text-danger" data-toggle="modal" data-target="#deleteModal<?php echo $row['id']; ?>">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $season; ?></td>
                                    <td><?php echo $night; ?></td>
                                    <td><?php echo $responsiblePerson; ?></td>
                                </tr>
                                <!-- Delete Tour Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete Tour</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this tour?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <a href="php/delete_tour.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Tour Modal -->
                                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Tour</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="php/update_tour.php" method="POST">
                                                    <input type="hidden" name="tourId" value="<?php echo $id; ?>">
                                                    <div class="form-group">
                                                        <label for="editTitle">Title:</label>
                                                        <input type="text" id="editTitle" name="editTitle" value="<?php echo $title; ?>" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editSeason">Season:</label>
                                                        <input type="text" id="editSeason" name="editSeason" value="<?php echo $season; ?>" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editNight">Nights:</label>
                                                        <input type="number" id="editNight" name="editNight" value="<?php echo $night; ?>" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editResponsible">Responsible Person:</label>
                                                        <input type="text" id="editResponsible" name="editResponsible" value="<?php echo $responsiblePerson; ?>" class="form-control">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>