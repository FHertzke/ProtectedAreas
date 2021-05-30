<!DOCTYPE html>

<?php
session_start();

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "protectedareas";

$server = new mysqli("localhost", "root", "", $dbname);

if ($server->connect_error) {
    die("Connection failed: " . $server->connect_error);
}*/

$conn = pg_connect("host=localhost dbname=protected_area user=postgres password=group2");
if (!$conn) {
    echo "An error occurred.\n";
    exit;
}

$existing = 0;

if(isset($_POST["Email"])) {
    $user = $_POST["Email"];
    $result = pg_prepare($conn, "test", 'SELECT * FROM "public"."users" WHERE LOWER("users"."Email") = LOWER($1)');
    $result = pg_execute($conn, "test", array("$user"));
    if (!$result) {
        echo "An error occurred.\n";
        die("Connection failed: " . pg_result_error($result));
    } else {
        $row = pg_fetch_row($result);
        if($row != null){
            $existing = 1;
        }else{
            echo '<script>alert("An account with that email already exists")</script>';
        }
    }
    if($user !== ""){
        $name = $_POST["FullName"];
        $pass = $_POST["Password"];
        $dob = $_POST["DOB"];
        $passwordmd5 = md5($pass);
        $signup = pg_prepare($conn, "signup", 'INSERT INTO public."users" ("Email", "FullName", "Password", "DOB") VALUES ($1, $2, $3, $4)');
        $signup = pg_execute($conn, "signup", array("$user", "$name", "$passwordmd5", "$dob"));
        echo pg_result_error($signup);
        header("Location: index.php");
    }
}

/*if(isset($_POST["Email"])){
    $user = $_POST["Email"];
    $sql = $server->prepare('SELECT * FROM users WHERE Email = ?');
    $sql->bind_param("s", $user);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    if($row != null){
        $existing = 1;
    }
    if($user !== ""){
        $name = $_POST["FullName"];
        $pass = $_POST["Password"];
        $dob = $_POST["DOB"];
        $passwordmd5 = md5($pass);
        mysqli_query($server, "INSERT INTO users (Email, FullName, Password, DOB) VALUES ('$user', '$name', '$passwordmd5', '$dob')");
        header("Location: index.php");
    }
}*/



?>



<html lang="en">

<head>
  <script>
    function validateForm() {
      email = document.forms["signup"]["Email"].value;
      cEmail = document.forms["signup"]["CEmail"].value;
      fullname = document.forms["signup"]["Name"].value;
      password = document.forms["signup"]["Password"].value;
      cPassword = document.forms["signup"]["CPassword"].value;
      dob = document.forms["signup"]["DOB"].value;
      if (email === "" || cEmail === "" || fullname === "" || password === "" || cPassword === "" || dob === "") {
        alert("Entire form must be filled out");
        return false;
      }
      if (!validateEmail(email.toString())) {
        alert("Please enter a valid Email");
        return false;
      }
      if (email !== cEmail) {
        alert("Emails are not matching");
        return false;
      }
      if (password !== cPassword) {
        alert("Passwords are not matching");
        return false;
      }
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = yyyy + '-' + mm + '-' + dd;
      if (dob > today) {
        alert("Please enter a valid date of birth");
        return false;
      }
    }

    function validateEmail() {
      var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      if (document.forms["signup"]["Email"].value.match(mailformat)) {
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

  <div class="jumbotron d-flex align-items-center">
    <div class="container text-center">

      <div class="container marketing mt-4 well col-md-6 col-centered">
        <div class="/">
          <?php
              if($existing == 1){
                  echo '<p id="warning">An account with that email already exists</p>';
              }
          ?>
          <form name="signup", action="signup.php", onsubmit="return validateForm()", method="post">



              <input type="text"  class="form-control" placeholder="Email" name="Email" size="25"><br>
              <input type="text" class="form-control" placeholder="Confirm Email" name="CEmail" size="25"><br>
              <input type="text" class="form-control" placeholder="Full Name" name="FullName" size="25"><br>
              <input type="password" class="form-control" placeholder="Password" name="Password" size="25"><br>
              <input type="password" class="form-control" placeholder="Confirm Password" name="CPassword" size="25"><br>
              <input type="date" class="form-control" placeholder="Date Of Birth" name="DOB" size="25"><br>
              <input type="submit" class="btn btn-primary" name="submit" value="Signup" id="loginButton">



          </form>
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





    <!-- container marketing -->

  </div>
  <div class="container marketing mt-4 ">



  </div>

  <hr>
  <div class="container-fluid">



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
H
