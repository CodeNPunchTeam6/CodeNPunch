<?php

//check connection
include "config.php";

// Start session
session_start();

// Connect to MySQL
$mysqli = new mysqli($host, $username, $passworddb, $dbname);

// Log user in if form submitted
if (isset($_POST['login'])) {

    // Escape special characters in username and password
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    // Check if user exists in database
    $sql = "SELECT * FROM data WHERE username='$username'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: homepage.html");
        } else {
            echo '<script> window.location.href = "login.html";alert("Incorrect")</script>';
           
        }
    } else {
         echo '<script> window.location.href = "login.html";alert("Invalid")</script>';
    }
}

// Close MySQL connection
$mysqli->close();

