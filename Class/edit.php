<?php
session_start();
    //check session
    if ($_SESSION['role']=="student") {
        header("location: index.php");
    }
  include "../config.php";
  $id="";
  $name="";
  $email="";
  $phone="";

  $error="";
  $success="";
  $errorarr = array("<", ">", "(", ")", "/", "\\", "\"", "'", ",", "@", "$", "!", "#", "%", "^", "&", "*", "[", "]", ";", "{", "}", "\"", "`", "~", "|", "+", "=", "-", "_", "?");

if($_SERVER["REQUEST_METHOD"]=='GET'){
    if(!isset($_GET['id'])){
      header("location: index.php");
      exit;
    }
    $id = str_replace($errorarr, "", $_GET['id']);
    $sql = "select * from student where id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    while(!$row){
      header("location: index.php");
      exit;
    }
    $name=$row["name"];
    $email=$row["email"];
    $phone=$row["phonenumber"];

  }
  else{
    $id = $_POST["id"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //invalid email
        echo 'Invalid email';
        $mysqli->close();
        exit();
    $sql = "update student set name='". str_replace($errorarr, "", $name) ."', email='$email', phonenumber='". str_replace($errorarr, "", $phone) ."' where id='$id'";    
    $result = $conn->query($sql);
    }  
  }
  
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CRUD</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="col-lg-6 m-auto">

            <form method="post">

                <br><br><div class="card">

                    <div class="card-header bg-warning">
                        <h1 class="text-white text-center">  Update Profile </h1>
                    </div><br>

                    <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> <br>

                    <label> NAME: </label>
                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control"> <br>

                    <label> EMAIL: </label>
                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control"> <br>

                    <label> PHONE: </label>
                    <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control"> <br>

                    <button class="btn btn-success" type="submit" name="submit"> Save </button><br>
                    <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

                </div>
            </form>
        </div>
    </body>
</html>