<?php
// Database credentials
$host = "localhost"; // Change this if your database is hosted elsewhere
$username = "root";
$passworddb = "";
$dbname = "serverlogin";

// Create connection
$conn = mysqli_connect($host, $username, $passworddb, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "";


