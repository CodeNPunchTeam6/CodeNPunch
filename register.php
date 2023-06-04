<?php

//check connect
include "config.php";
//html contents
echo file_get_contents('./HTMLfile/register.html');
// Connect to MySQL
$mysqli = new mysqli($host, $username, $passworddb, $dbname);

if (isset($_POST['register'])) {

    // Escape special characters in username and password
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phonenumber = $mysqli->real_escape_string($_POST['phonenumber']);
    $role = (bool) $_POST['role'];
    $id = 0;
    
    // generate id for student table
    $sql = "SELECT MAX(id) as max_id FROM student";
    $result = $mysqli->query($sql);
    $row = mysqli_fetch_assoc($result);

    // Set the new ID
    $new_id = $row['max_id'] + 1;

    //check username are taken or not
    $sql = "SELECT * FROM data WHERE username='$username'";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Username is taken.";
        $mysqli->close();
        exit();
    }
    
    //check valid password
    $errors = array();
    if (strlen($password) < 8 || strlen($password) > 20) {
        $errors[] = "Password should be min 8 characters and max 20 characters";
    }
    elseif (!preg_match("/\d/", $password)) {
        $errors[] = "Password should contain at least one digit";
    }
    elseif (!preg_match("/[A-Z]/", $password)) {
        $errors[] = "Password should contain at least one Capital Letter";
    }
    elseif (!preg_match("/[a-z]/", $password)) {
        $errors[] = "Password should contain at least one small Letter";
    }
    elseif (!preg_match("/\W/", $password)) {
        $errors[] = "Password should contain at least one special character";
    }
    elseif (preg_match("/\s/", $password)) {
        $errors[] = "Password should not contain any white space";
    }

    if ($errors) {
        foreach ($errors as $error) {
            echo $error . "\n";
            $mysqli->close();
            exit();
        }
        die();
    } else {        
        $password = password_hash($mysqli->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    }

    //check valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //invalid email
        echo '<script> window.location.href = "register.php";alert("Failed, invalid Email!!")</script>';
        $mysqli->close();
        exit();
    }


    
    //insert into student table if role = 0
    if ($role == 0) {
        $sql = "INSERT INTO data (username, password, fullname, email, phonenumber, role) VALUES ('$username', '$password', '$fullname', '$email', '$phonenumber', '$role')";
        $mysqli->query($sql);
        $sql = "INSERT INTO student (id, fullname, email, phonenumber) VALUES ('$new_id', '$fullname', '$email', '$phonenumber')";
    } else {
        // Insert user info into database
        $sql = "INSERT INTO data (username, password, fullname, email, phonenumber, role, id) VALUES ('$username', '$password', '$fullname', '$email', '$phonenumber', '$role')";
    }

    if ($mysqli->query($sql) === TRUE) {
        echo 'Registation success';
    } else {
        echo 'Registation failed';
    }
}

// Close MySQL connection
$mysqli->close();
