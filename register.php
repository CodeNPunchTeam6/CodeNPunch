<?php
include "config.php";
// Connect to MySQL
$mysqli = new mysqli($host, $username, $passworddb, $dbname);

if (isset($_POST['register'])) {

    // Escape special characters in username and password
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = password_hash($mysqli->real_escape_string($_POST['password']), PASSWORD_DEFAULT);

    // Insert user info into database
    $sql = "INSERT INTO login (username, password) VALUES ('$username', '$password')";

    if ($mysqli->query($sql) === TRUE) {
        echo '<script> window.location.href = "register.html";alert("Success")</script>';
    } else {
        echo '<script> window.location.href = "register.html";alert("Failed")</script>';
    }
}

// Close MySQL connection
$mysqli->close();
