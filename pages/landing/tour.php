<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

  <title>Akman Tourism</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/owl.css">

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
  <div id="header-container"></div>

  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="heading-page header-text">
    <section class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-content">
              <h4>Packages</h4>
              <h2>Choose from our packages!</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Banner Ends Here -->

  <section class="blog-posts grid-system">
    <div class="container">
      <div class="all-blog-posts">
        <div class="row">
          <?php
          // Database connection parameters
          $servername = "localhost";
          $username = "root";
          $password = "2MbpkT[)ZQPej[T~";
          $dbname = "ws";

          // Create a new PDO instance
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

          // Prepare and execute the SQL query to fetch tour titles and summaries
          $stmt = $conn->prepare("SELECT title, summary, season, night FROM posts");
          $stmt->execute();

          // Fetch all rows from the result set
          $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Loop through the tours and display them
          foreach ($tours as $tour) {
            $title = $tour['title'];
            $summary = $tour['summary'];
            $season = $tour['season'];
            $night = $tour['night'];
          ?>
            <div class="col-md-4 col-sm-6">
              <div class="blog-post">
                <div class="blog-thumb">
                  <img src="assets/images/product-3-720x480.jpg" alt="">
                </div>
                <div class="down-content">
                  <a href="tour-details.html">
                    <h4><?php echo $title; ?></h4>
                  </a>
                  <p><?php echo $summary; ?></p>
                  <div class="post-options">
                    <div class="row">
                      <div class="col-lg-12">
                        <ul class="post-tags">
                          <li><i class="fa fa-calendar"></i> <?php echo $season; ?> &nbsp;</li>
                          <li><i class="fa fa-cube"></i> <?php echo $night; ?> night &nbsp;</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }

          // Close the database connection
          $conn = null;
          ?>
        </div>
      </div>
    </div>
  </section>



  <footer>
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
            <p>
              Copyright © 2024 Akman Tourism
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Additional Scripts -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/owl.js"></script>
  <script src="assets/js/slick.js"></script>
  <script src="assets/js/isotope.js"></script>
  <script src="assets/js/accordions.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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