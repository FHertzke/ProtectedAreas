<!DOCTYPE html>
<?php
    session_start();

    $logged = 0;

    $conn = pg_connect("host=localhost dbname=protectedareas user=postgres password=qh4zpmwrbf");
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
        function validateEmail()
        {
            var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if(document.forms["login"]["Email"].value.match(mailformat))
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
<iframe class="message" id="map" frameborder="0" allowfullscreen src="//umap.openstreetmap.fr/en/map/untitled-map_607602?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&searchControl=null&tilelayersControl=null&embedControl=null&datalayersControl=true&onLoadPanel=undefined&captionBar=false"></iframe>
<div class="message" id="menuDiv">
    <div id="loginDiv">
    <?php
        if($logged == 0){
            echo '<form name="login", action="index.php", onsubmit="return validateForm()", method="post">';
            echo '<input type="text" placeholder="Email" name="Email" size="25"><br>';
            echo '<input type="password" placeholder="Password" name="Password" size="25"><br>';
            echo '<input type="submit" name="submit" value="Login" id="loginButton">';
            echo '</form>';
            echo '<a href="signup.php">Signup</a>';
        }else{
            echo '<h2>Welcome ';
            echo $row[1];
            echo '</h2>';
            echo '<form name="login", action="index.php", method="post">';
            echo '<input type="hidden" name="Password" value="">';
            echo '<input type="hidden" name="Email" value=null>';
            echo '<input type="submit" name="submit" value="Logout" id="loginButton">';
            echo '</form>';
        }
        ?>
    </div>
    <div id="searchDiv">
        <form name="login", action="index.php", method="post">
            <input type="text" placeholder="Search Area" name="Search" size="25" id="searchBox"><br><br>
            <input type="submit" name="submit" value="Search" id="loginButton">
        </form>
    </div>
    <h1>Protected Areas NZ</h1>
</div>
<div class="message" id="filterDiv">
    <h3>Filter as:</h3>
</div>
<div class="message" id="areaInfoDiv">
    <h3>Selected Area Info:</h3>
</div>
<div class="message" id="listDiv" style="overflow-y:scroll">
    <h3>My list:</h3>
</div>
<div class="message" id="socialDiv">
    <h3>Area Reviews</h3>
</div>
<div class="message" id="reviewDiv">
    <h3>Comment and Review Selected Area</h3>
</div>
</body>
</html>