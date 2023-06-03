<?php


//check connect
//include "config.php";

//html contents
//echo file_get_contents('./HTMLfile/register.html');
// Connect to MySQL
//$mysqli = new mysqli($host, $username, $passworddb, $dbname);

if (isset($_POST['register'])) {

    // Escape special characters in username and password
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = password_hash($mysqli->real_escape_string($_POST['password']), PASSWORD_DEFAULT);   
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phonenumber =$mysqli->real_escape_string($_POST['phonenumber']);
    $role = (bool)$_POST['role'];
    //check valid password
    $errors = array();
if (strlen($password) < 8 || strlen($password) > 20) {
    $errors[] = "Password should be min 8 characters and max 20 characters";
}
if (!preg_match("/\d/", $password)) {
    $errors[] = "Password should contain at least one digit";
}
if (!preg_match("/[A-Z]/", $password)) {
    $errors[] = "Password should contain at least one Capital Letter";
}
if (!preg_match("/[a-z]/", $password)) {
    $errors[] = "Password should contain at least one small Letter";
}
if (!preg_match("/\W/", $password)) {
    $errors[] = "Password should contain at least one special character";
}
if (preg_match("/\s/", $password)) {
    $errors[] = "Password should not contain any white space";
}

if ($errors) {
    foreach ($errors as $error) {
        echo $error . "\n";
    }
    die();
} else {
    echo "$pass => MATCH\n";
}
    
    //check valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //invalid email
        echo '<script> window.location.href = "register.php";alert("Failed, invalid Email!!")</script>';
        $mysqli->close();
    }

    // Insert user info into database
    $sql = "INSERT INTO data (username, password, fullname, email, phonenumber, role) VALUES ('$username', '$password', '$fullname', '$email', '$phonenumber', '$role')";

    if ($mysqli->query($sql) === TRUE) {
        echo '<script> window.location.href = "register.php";alert("Success")</script>';
    } else {
        echo '<script> window.location.href = "register.php";alert("Failed")</script>';
    }
}

// Close MySQL connection
//$mysqli->close();
