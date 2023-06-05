<?php
session_start();

if (isset($_SESSION['username'])) {
    echo file_get_contents('./HTMLfile/home.html');
    echo "Welcome back,".$_SESSION['username'];
    session_write_close();
} else {
    echo '<script> window.location.href = "login.php";alert("You need to login first")</script>';
}
?>
