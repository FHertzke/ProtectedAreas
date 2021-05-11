<!DOCTYPE html>
<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "protectedareas";

    $server = new mysqli("localhost", "root", "", $dbname);

    if ($server->connect_error) {
        die("Connection failed: " . $server->connect_error);
    }

    $logged = 0;
    $userID = null;

    if(isset($_POST["Email"])){
        $user = $_POST["Email"];
        $pass = $_POST["Password"];
        $sql = $server->prepare('SELECT * FROM users WHERE Email = ? AND BINARY Password = ?');
        $sql->bind_param("ss", $user, $pass);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        if($row != null){
            $logged = 1;
            $userID = $row['ID'];
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
        }else{
            echo '<h2>Welcome ';
            echo $row['Name'];
            echo '</h2>';
            echo '<form name="login", action="index.php", method="post">';
            echo '<input type="hidden" name="Password" value="">';
            echo '<input type="hidden" name="Email" value="">';
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
    <h4>
    <?php
        echo $userID;
    ?>
    </h4>
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