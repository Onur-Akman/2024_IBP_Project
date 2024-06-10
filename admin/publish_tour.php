<!-- publish_tour.html -->
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
    /* Additional custom styles */
    body {
      background-color: #f8f9fc;
      padding-top: 20px;
    }

    .container {
      background-color: #fff;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="email"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .form-group input[type="submit"] {
      background-color: #4e73df;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div id="wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="container">
      <h1 class="h3 mb-4">Publish Tour</h1>

      <form id="publishForm" action="php/submit_tour.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title" class="text-gray-800">Title:</label>
          <input type="text" id="title" name="title" required class="form-control">
        </div>

        <div class="form-group">
          <label for="season" class="text-gray-800">Season:</label>
          <input type="text" id="season" name="season" required class="form-control">
        </div>

        <div class="form-group">
          <label for="night" class="text-gray-800">Nights:</label>
          <input type="number" id="night" name="night" required class="form-control">
        </div>

        <div class="form-group">
          <label for="responsible" class="text-gray-800">Responsible Person:</label>
          <input type="text" id="responsible" name="responsible" required class="form-control">
        </div>

        <div class="form-group">
          <label for="email" class="text-gray-800">Email:</label>
          <input type="email" id="email" name="email" required class="form-control">
        </div>

        <div class="form-group">
          <label for="summary" class="text-gray-800">Summary:</label>
          <textarea id="summary" name="summary" required class="form-control"></textarea>
        </div>

        <!-- image send -->
        <!--<div class="form-group">
          <label for="image" class="text-gray-800">Image:</label>
          <input type="file" id="image" name="image" class="form-control-file">
        </div>-->

        <div class="form-group">
          <input type="submit" value="Submit" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>

  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Success</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Tour submitted successfully!</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    // Submit form using AJAX
    $(document).ready(function() {
      $('#publishForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: $(this).serialize(),
          success: function(response) {
            $('#successModal').modal('show'); // Show success modal
            $('#publishForm')[0].reset(); // Reset form fields
          }
        });
      });
    });
  </script>

</body>

</html>
