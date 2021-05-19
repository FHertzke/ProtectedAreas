<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airline";

$server = new mysqli("localhost", "root", "", $dbname);

date_default_timezone_set('NZ');
$todayDate = date("d/m/y");

if ($server->connect_error) {
    die("Connection failed: " . $server->connect_error);
}

?>