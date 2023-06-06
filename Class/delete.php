<?php
session_start();
    //check session
    if ($_SESSION['role']=="student") {
        header("location: index.php");
        $mysqli->close();
    }
    include "../config.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE from student where id=$id";
        $conn->query($sql);
    }
    header('location: index.php');
    exit;
?>