<?php
session_start();
include "config.php";

if (isset($_SESSION['username'])) {
    
    
    if ($_SESSION['role']=="student") {
        $sql = "select * from student";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
    } else  {
        $sql = "select * from teacher";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    $id=$row['id'];
    echo "<!DOCTYPE html>

<html>
    <head>
        <title>Home</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            /* Add a black background color to the top navigation */
            .topnav {
                background-color: #333;
                overflow: hidden;
            }

            /* Style the links inside the navigation bar */
            .topnav a {
                float: left;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }

            /* Change the color of links on hover */
            .topnav a:hover {
                background-color: #ddd;
                color: black;
            }

            /* Add a color to the active/current link */
            .topnav a.active {
                background-color: #04AA6D;
                color: white;
            }
        </style>
    </head>
    
    <body>
        <div class='topnav'>
            <a href='./userinfo/index.php?id=$id'>User Info</a>
            <a href='./Classwork'>Classwork</a>
            <a href='./Class'>CLass</a>
            <a href='logout.php'>Logout</a>
        </div>
    </body>
</html>";
    session_write_close();
} else {
    echo '<script> window.location.href = "login.php";alert("You need to login first")</script>';
}
?>
