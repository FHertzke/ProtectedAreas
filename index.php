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
      <a class="navbar-brand d-flex align-items-center text-white font-weight-bolder mb-0 h3" href="homepage.php">Protected Areas of NZ</a>
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

    <div class="jumbotron d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-1 mb-4">P.A<br>NZ</h1>
            <h3>Maps for Natural Adventurer</h3>
            <a href="home.php" class="btn btn-outline-danger btn-lg h">
                <h2>Start exploring>>></h2>
            </a>
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



        <!-- container marketing -->

    </div>
    <div class="container marketing mt-4 ">
        <div class="row">
            <div class="col-lg-3 mt-2 text-center">
                <img class="bd-placeholder-img rounded-circle d-flex m-auto" width="140" height="140"
                    src="img/locations.png" alt="img1">
                <h2 class='text-center'>Top Locations</h2>
                <a href="locations.php" class="btn btn-success">Visit now</a>
            </div>
            <div class="col-lg-3 mt-2 text-center">
                <img class="bd-placeholder-img rounded-circle d-flex m-auto" width="140" height="140" src="img/todo.jpg"
                    alt="img1">
                <h2 class='text-center'>Things to do</h2>
                <a href="thingstodo.php" class="btn btn-success">Things to do</a>
            </div>
            <div class="col-lg-3 mt-2 text-center">
                <img class="bd-placeholder-img rounded-circle d-flex m-auto" width="140" height="140"
                    src="img/help.jpeg" alt="img1">
                <h2 class='text-center'>Need Help?</h2>

                <a href="help.php" class="btn btn-success">Help</a>
            </div>
            <div class="col-lg-3 mt-2 text-center">
                <img class="bd-placeholder-img rounded-circle d-flex m-auto" width="140" height="140"
                    src="img/contact.jpeg" alt="img1">
                <h2 class='text-center'>Contact Us</h2>

                <a href="contact.php" class="btn btn-success">Contact us</a>
            </div>
        </div>
    </div>

    <hr>
    <div class="container-fluid">
        <h2 class="text-center my-2">Keep Planning</h2><br>
        <div class="row rounded mx-1" style="background-color: #ff5d5d;">
            <div class="col-lg-6 col-12 p-1 text-center">
                <br>
                <h1 class="text-center text-light">Start saving your travel ideas</h1><br>
                <p class="text-center text-light">Create a Trip to save and organise all of your travel ideas, and see
                    them on a map</p>
                <br><a href="thingstodo.php" class="btn btn-primary rounded-pill ">Explore now</a><br>

            </div>
            <div class="col-lg-6 col-12 p-2">
                <div class="card mb-6 shadow-sm d-block">
                    <iframe class="message" id="map" frameborder="0" allowfullscreen=""
                        src="map.html"></iframe>

                </div>
            </div>
        </div>

        <div class="container-fluid py-2">
            <div class="row rounded my-1 bg-primary py-1">
                <div class="col-lg-6 col-12 p-1 text-center">
                    <div class="card mb-6 shadow-sm d-block"> <iframe src="https://www.youtube.com/embed/utLf6YkjAB4"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-12 p-2 text-center">
                    <br>
                    <h1 class="text-center text-light">Explore the Beauty of New Zeeland</h1><br>
                    <p class="text-center text-light">Create a Trip to save and organise all of your travel ideas, and
                        see
                        them on a map</p>
                    <br><a href="contact.php" class="text-decoration-none btn btn-danger rounded-pill">Contact
                        Us</a><br>
                </div>
            </div>
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
    </footer>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script src="vendor/bootstrap/popper.min.js"></script>
    <script src="vendor/bootstrap/bootstrap.min.js"></script>
</body>

</html>
