<!DOCTYPE html>

<?php
    session_start();

    $logged = 0;

    $conn = pg_connect("host=localhost dbname=protected_area user=postgres password=group2");
    if (!$conn) {
        echo "An error occurred.\n";
        exit;
    }
    if(isset($_POST["Email"])) {
        $user = $_POST["Email"];
        $pass = md5($_POST["Password"]);
        $result = pg_prepare($conn, "test", 'SELECT * FROM "public"."users" WHERE LOWER("users"."Email") = LOWER($1) AND "users"."Password" = $2');
        $result = pg_execute($conn, "test", array("$user", "$pass"));
        if (!$result) {
            echo "An error occurred.\n";
            die("Connection failed: " . pg_result_error($result));
        } else {
            $row = pg_fetch_row($result);
            if($row != null){
                $logged = 1;
            }else{
                echo '<script>alert("incorrect username or password")</script>';
            }
        }
    }

?>


<html lang="en">

<head>
  <script>
    function validateForm() {
      x = document.forms["login"]["Email"].value;
      if (x === "") {
        alert("Email must be filled out");
        return false;
      }
      if (!validateEmail(x.toString())) {
        alert("Please enter a valid Email");
        return false;
      }
    }

    function validateEmail() {
      var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      if (document.forms["login"]["Email"].value.match(mailformat)) {
        return true;
      } else {
        return false;
      }
    }
  </script>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Protected Areas of New Zealand for Natural Lover</title>
  <meta name="description" content="P.ANZ">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- External CSS -->
  <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.min.css">
  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

</head>

<body data-spy="scroll" data-target="#navbar" class="static-layout">
  <nav id="header-navbar" class="navbar navbar-expand-lg py-4">
    <div class="container">
      <div class="anim">
        <a href="index.php">
          <img class="rounded-circle mr-4 border border-white p-1" width="50" height="50" src="img/logo2.png" alt=""></a>
      </div>
      <a class="navbar-brand d-flex align-items-center text-white font-weight-bolder mb-0 h3" href="index.php">Protected Areas of NZ</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header" aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
        <span class="lnr lnr-menu"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-nav-header">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="thingstodo.php">Things to do</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="locations.php">Locations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="help.php">Help</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contacts</a>
          </li>
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm">Account</button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <div class="dropdown-menu">
              <?php
                if($logged == 0) {
                  echo '<a class="dropdown-item" href="Loginpage.php">Login</a>';
                  echo '<a class="dropdown-item" href="signup.php">SignUp</a>';
                }else{
                  echo '<a class="dropdown-item">Welcome ';
                  echo $row[1];
                  echo '</a>';
                }
              ?>
            </div>
          </div>

        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron d-flex align-items-center ">
    <div class="container text-center mt-4  rounded opacity-2">
      <div class="row">
        <div class="col-md-6 col-12">
          <h2 class="mt-4">Some Information Here !!!</h2><br><br>


          <blockquote>
            <p><em>Aotearoa is the </em>Maori name for New Zealand meaning "Land of the Long White Cloud"</p>
            <p>&nbsp;</p>
            <h3><a href="locations.php" class="text-warning">Top Locations</a></h3>
            <p>&nbsp;</p>

            <h3><a href="thingstodo.php" class="text-warning">10 Things to do in New Zealand</a></h3>
            <p>&nbsp;</p>
            <h3><a href="Help.php" class="text-warning">Help center</a></h3>
            <p>&nbsp;</p>
            <h4><em>"The trip was just magical! I didn't want it to end. And all the arrangements worked like clockwork - thank you for putting it all together."</em></h4>
            <h4><em>Jonquil, NZ</em></h4>
            <p>&nbsp;</p>
            <h4><em>“Many thanks for help our itinerary for our trip to the South Island, New Zealand. Our routes and trips have all been arranged and professional map has made it easy and trouble free
                for us.”</em></h4>
            <h4><em>Janet, UK</em></h4>
            <p>&nbsp;</p>
            <h4><em>"Your site was spot on which meant we could maximise our time doing the activities we wanted rather than organising logistics."</em></h4>
            <h4><em>Stuart and Monique, Australia</em></h4>
            <p>&nbsp;</p>
          </blockquote>
        </div>
        <div class="col-md-6 col-12 mt-4">

          <div class="custom story">
            <h4 class="alert alert-danger bg-danger text-white text-center"> <a class="text-uppercase text-white text-center"> ABOUT THIS Website↓↓↓</a> </h4>
            <h4 class="alert alert-warning"> The Purpose of this website is to help users use this website correctly. Instruct users to use various functions.</h4>
            <h4 class="alert alert-warning"> If you are interested in New Zealand nature reserves and would like to learn more about the functions of this website >>> <a href="help.php"> <u>Help Page</u></a>.
              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
              ✓Students&nbsp; &nbsp;
              ✓Natural Reserve Lovers
              ✓Traveler&nbsp; &nbsp;
              ✓Related practitioners
            </h4>
            <h4 class="alert alert-danger bg-danger text-white text-center"> <a class="text-uppercase text-white text-center" > About this project</a> </h4>
            <h4 class="alert alert-warning">We are committed to creating a website where users can search and view all protected areas in New Zealand. This website provides basic search, view details, satellite topographic maps, search by protected area category and other functions.</h4>
            <h5>&nbsp;</h5>
          </div>

          <div class="custom story">
            <h4 class="alert alert-danger bg-danger text-white text-center"> <a class="text-uppercase text-white text-center" href="https://covid19.govt.nz/"> NZ COVID-19 information here↓↓↓</a> </h4>
            <h4 class="alert alert-warning">If you are thinking about booking a trip during the next few months, but are unsure how any travel restrictions related to COVID-19 may impact your travel, don't worry we can help you to plan first.</h4>
            <h4 class="alert alert-danger bg-danger text-white text-center"> <a class="text-uppercase text-white text-center" href="https://covid19.govt.nz/"> If you are unwell↓↓↓
              </a> </h4>
            <h4 class="alert alert-warning">Staying at home if you’re sick is especially important at Alert Level 1. The risk of COVID-19 being spread in the community is much greater when there are no restrictions on gatherings or going out. </h4>
            <h5>&nbsp;</h5>
          </div>

        </div>
      </div>
    </div>
    <div class="rectangle-1"></div>
    <div class="rectangle-2"></div>
    <div class="rectangle-transparent-1"></div>
    <div class="rectangle-transparent-2"></div>
    <div class="circle-1"></div>
    <div class="circle-2"></div>
    <div class="circle-3"></div>
    <div class="triangle triangle-1">
      <img src="img/obj_triangle.png" alt="">
    </div>
    <div class="triangle triangle-2">
      <img src="img/obj_triangle.png" alt="">
    </div>
    <div class="triangle triangle-3">
      <img src="img/obj_triangle.png" alt="">
    </div>
    <div class="triangle triangle-4">
      <img src="img/obj_triangle.png" alt="">
    </div>
  </div>

  <footer class="mastfoot my-3">
    <div class="inner container">




      <div class="row">
        <div class="col-lg-4 col-md-12 d-flex align-items-center">

        </div>
        <div class="col-lg-4 col-md-12 d-flex align-items-center">
          <p class="mx-auto text-center mb-0">&copy; 2021 P.ANZ. Designed by P.ANZ developers</p>
        </div>

        <div class="col-lg-4 col-md-12">
          <nav class="nav nav-mastfoot justify-content-center">
            <a class="nav-link" href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="nav-link" href="#">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="nav-link" href="#">
              <i class="fab fa-instagram"></i>
            </a>
            <a class="nav-link" href="#">
              <i class="fab fa-linkedin"></i>
            </a>
            <a class="nav-link" href="#">
              <i class="fab fa-youtube"></i>
            </a>
          </nav>
        </div>

      </div>
    </div>
  </footer> <!-- External JS -->
  <!-- External JS -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
  <script src="vendor/bootstrap/popper.min.js"></script>
  <script src="vendor/bootstrap/bootstrap.min.js"></script>
</body>

</html>
