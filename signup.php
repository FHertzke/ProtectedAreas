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

$conn = pg_connect("host=localhost dbname=protectedareas user=postgres password=qh4zpmwrbf");
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
<html>
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
                if(email !== cEmail){
                    alert("Emails are not matching");
                    return false;
                }
                if(password !== cPassword){
                    alert("Passwords are not matching");
                    return false;
                }
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                if(dob > today){
                    alert("Please enter a valid date of birth");
                    return false;
                }
            }
            function validateEmail()
            {
                var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                if(document.forms["signup"]["Email"].value.match(mailformat))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        </script>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" href="Styles.css" type="text/css"/>
    </head>
    <body>
        <div class="message" id="signupDiv">
            <?php
                if($existing == 1){
                    echo '<p id="warning">An account with that email already exists</p>';
                }
            ?>
            <form name="signup", action="signup.php", onsubmit="return validateForm()", method="post">
                <input type="text" placeholder="Email" name="Email" size="25"><br>
                <input type="text" placeholder="Confirm Email" name="CEmail" size="25"><br>
                <input type="text" placeholder="Full Name" name="FullName" size="25"><br>
                <input type="password" placeholder="Password" name="Password" size="25"><br>
                <input type="password" placeholder="Confirm Password" name="CPassword" size="25"><br>
                <input type="date" placeholder="Date Of Birth" name="DOB" size="25"><br>
                <input type="submit" name="submit" value="Signup" id="loginButton">
            </form>
        </div>
    </body>
</html>