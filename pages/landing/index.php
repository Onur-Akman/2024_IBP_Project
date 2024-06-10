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
  <div class="main-banner header-text">
    <div class="container-fluid">
      <div class="owl-banner owl-carousel">
        <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "2MbpkT[)ZQPej[T~";
        $dbname = "ws";

        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Prepare and execute the SQL query to fetch tour titles, summaries, and images
        $stmt = $conn->prepare("SELECT title, summary FROM posts LIMIT 6");
        $stmt->execute();

        // Fetch all rows from the result set
        $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Loop through the tours and display them
        foreach ($tours as $tour) {
          $title = $tour['title'];
          $summary = $tour['summary'];
        ?>
          <div class="item">
            <img src="assets/images/product-4-720x480.jpg" alt="" />
            <div class="item-content">
              <div class="main-content">
                <a href="tour-details.html ">
                  <h4><?php echo $title; ?></h4>
                </a>
                <p style="color: white;"><?php echo $summary; ?></p>
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
  <!-- Banner Ends Here -->


  <section class="call-to-action">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="main-content">
            <div class="row">
              <div class="col-lg-8">
                <span>Start your unforgettable journey now!</span>
                <h4>Explore the world with us.</h4>
              </div>
              <div class="col-lg-4">
                <div class="main-button">
                  <a href="tour.php">Tours</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="blog-posts grid-system">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="all-blog-posts">
            <h2 class="text-center">Guides</h2>
            <div class="row justify-content-center">
              <?php
              // Database connection parameters
              $servername = "localhost";
              $username = "root";
              $password = "2MbpkT[)ZQPej[T~";
              $dbname = "ws";

              // Create a new PDO instance
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

              // Prepare and execute the SQL query to fetch guide details
              $stmt = $conn->prepare("SELECT title, summary, guide, published_date FROM guides ORDER BY published_date DESC LIMIT 3");
              $stmt->execute();

              // Fetch all rows from the result set
              $guides = $stmt->fetchAll(PDO::FETCH_ASSOC);

              // Loop through the guides and display them
              foreach ($guides as $guide) {
                $title = $guide['title'];
                $summary = $guide['summary'];
                $guideName = $guide['guide'];
                $publishedDate = $guide['published_date'];
              ?>
                <div class="col-md-4 col-sm-6">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="assets/images/blog-1-720x480.jpg" alt="">
                    </div>
                    <div class="down-content text-center">
                      <a href="blog-details.html">
                        <h4><?php echo $title; ?></h4>
                      </a>
                      <p><?php echo $summary; ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-lg-12">
                            <ul class="post-tags">
                              <li><i class="fa fa-user"></i> <?php echo $guideName; ?></li>
                              <li><i class="fa fa-calendar"></i> <?php echo $publishedDate; ?></li>
                              <!-- Add more fields from the guides table here -->
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
      </div>
    </div>
  </section>


  <div class="blog-posts">
    <div class="container">
      <div class="sidebar-item comments">
        <h2 class="text-center">Experts</h2>
        <br />
        <br />
        <div class="content">
          <ul>
            <li>
              <div class="author-thumb">
                <img src="assets/images/comment-author-01.jpg" alt="" />
              </div>
              <div class="right-content">
                <h4>John Doe<span>10.07.2020</span></h4>
                <p>
                  John Doe is a seasoned traveler with extensive experience in
                  exploring various destinations. His insights and
                  recommendations have helped countless travelers make the
                  most of their journeys.
                </p>
              </div>
            </li>
            <li>
              <div class="author-thumb">
                <img src="assets/images/comment-author-02.jpg" alt="" />
              </div>
              <div class="right-content">
                <h4>Jane Smith<span>10.07.2020</span></h4>
                <p>
                  Jane Smith is an avid adventurer who has ventured into
                  remote and exotic locations. With her adventurous spirit and
                  in-depth knowledge, she has inspired many to step out of
                  their comfort zones and embrace new experiences.
                </p>
              </div>
            </li>
            <li>
              <div class="author-thumb">
                <img src="assets/images/comment-author-03.jpg" alt="" />
              </div>
              <div class="right-content">
                <h4>Kate Blue<span>10.07.2020</span></h4>
                <p>
                  Kate Blue is a passionate traveler who has immersed herself
                  in different cultures around the world. Her unique
                  perspectives and cultural understanding have enriched the
                  travel experiences of numerous individuals.
                </p>
              </div>
            </li>
          </ul>
        </div>

        <br />
        <br />

        <div class="row justify-content-md-center">
          <div class="col-md-3">
            <div class="main-button">
              <a href="expert.html">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
            <p>Copyright © 2024 Akman Tourism</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
    $(function() {
      $("#header-container").load("header.php");
    });
  </script>

  <!-- Additional Scripts -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/owl.js"></script>
  <script src="assets/js/slick.js"></script>
  <script src="assets/js/isotope.js"></script>
  <script src="assets/js/accordions.js"></script>

  <script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) {
      //declaring the array outside of the
      if (!cleared[t.id]) {
        // function makes it static and global
        cleared[t.id] = 1; // you could use true and false, but that's more typing
        t.value = ""; // with more chance of typos
        t.style.color = "#fff";
      }
    }
  </script>
</body>

</html>