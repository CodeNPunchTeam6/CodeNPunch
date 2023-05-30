<?php
include "config.php";
// Connect to MySQL
$mysqli = new mysqli($host, $username, $passworddb, $dbname);

if (isset($_POST['register'])) {

    // Escape special characters in username and password
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = password_hash($mysqli->real_escape_string($_POST['password']), PASSWORD_DEFAULT);   
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phonenumber =$mysqli->real_escape_string($_POST['phonenumber']);
    $role = (bool)$_POST['role'];
    
    //check valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //invalid email
        echo '<script> window.location.href = "register.html";alert("Failed, invalid Email!!")</script>';
        $mysqli->close();
    }

    // Insert user info into database
    $sql = "INSERT INTO data (username, password, fullname, email, phonenumber, role) VALUES ('$username', '$password', '$fullname', '$email', '$phonenumber', '$role')";

    if ($mysqli->query($sql) === TRUE) {
        echo '<script> window.location.href = "register.html";alert("Success")</script>';
    } else {
        echo '<script> window.location.href = "register.html";alert("Failed")</script>';
    }
}

// Close MySQL connection
$mysqli->close();
