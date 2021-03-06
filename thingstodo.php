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

<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(img/bg.jpg)">
  <div class="container text-center">

    <section id="blog" >
        <div class="container">
            <h2 class="text-center pt-4">TOP 10 THINGS TO DO IN NEW ZEELAND</h2>
            <div class="section-content">
                <div class="row">
                    <!-- Blog -->
                    <div class="col-md-12 blog-holder text-dark">
                        <div class="row">
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/1.jpeg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Skydiving</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p> /

                                        </div>
                                        <div class="blog-desc">
                                            <p class="text-dark">Embrace the excitement and soak in the views as you tandem skydive or go solo ??? a true heart-stopping adventure! You can skydive in various locations around New Zealand, including Wanaka, Queenstown, Lake Taupo, Auckland and Bay of Plenty.</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/2.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Bungy</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p> /

                                        </div>
                                        <div class="blog-desc">
                                            <p>Take a leap of faith on a bungy at the original Kawarau Bungy site, or New Zealand's highest . Or for a completely different style of bungy, why not try the Auckland Harbour Bridge or Taupo Bungy on the Waikato River. As the home of bungy, New Zealand doesn???t</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/3.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Jet Boating</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p> /

                                        </div>
                                        <div class="blog-desc">
                                            <p>Lorem ipsum dolor sit amet con sectetur adipiscing elit sed do eiu smod tempor incididunt ut labore et dolore magna aliqua dolore magna aliqua et dolore magna aliqua dolore magna aliqua magna aliqua dolore magna aliqua.</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/4.jpeg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Rafting</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p>
                                        </div>
                                        <div class="blog-desc">
                                            <p>Lorem ipsum dolor sit amet con sectetur adipiscing elit sed do eiu smod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/5.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Caving</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p> /

                                        </div>
                                        <div class="blog-desc">
                                            <p>Lorem ipsum dolor sit amet con sectetur adipiscing elit sed do eiu smod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/6.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Zip Lining</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p> /

                                        </div>
                                        <div class="blog-desc">
                                            <p>Lorem ipsum dolor sit amet con sectetur adipiscing elit sed do eiu smod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/7.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Canyoning</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p> /

                                        </div>
                                        <div class="blog-desc">
                                            <p>Lorem ipsum dolor sit amet con sectetur adipiscing elit sed do eiu smod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/8.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Off-road Driving</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p> /

                                        </div>
                                        <div class="blog-desc">
                                            <p class="text-dark">Lorem ipsum dolor sit amet con sectetur adipiscing elit sed do eiu smod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                            <!-- Blog Item -->
                            <div class="col-md-4 blog-item-wrapper" data-aos="fade-up" data-aos-delay="400">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <a href="#"><img src="img/thingstodo/9.jpg" alt=""></a>
                                    </div>
                                    <div class="blog-text">
                                        <div class="blog-tag">
                                            <a href="#"><h6><small>ADVENTURE</small></h6></a>
                                        </div>
                                        <div class="blog-title">
                                            <a href="#"><h4>Heli-skiing</h4></a>
                                        </div>
                                        <div class="blog-meta">
                                            <p class="blog-date">25 Dec 2020</p> /

                                        </div>
                                        <div class="blog-desc">
                                            <p>Lorem ipsum dolor sit amet con sectetur adipiscing elit sed do eiu smod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                        <div class="blog-author">
                                            <p>by P.ANZ team</p>
                                        </div>
                                        <div class="blog-share-wrapper">
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a class="blog-share" href="google.com">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Blog Item -->
                        </div>
                    </div>
                    <!-- End of Blog -->
                </div>
            </div>
        </div>
    </section>

  </div>
</div>
	<!-- Blog Section -->

<!-- End of Blog Section -->
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
</footer>	<!-- External JS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	<script src="vendor/bootstrap/popper.min.js"></script>
	<script src="vendor/bootstrap/bootstrap.min.js"></script>

	<!-- Main JS -->
	<script src="js/app.min.js "></script>
</body>
</html>
