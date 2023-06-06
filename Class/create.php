<?php
    session_start();
    //check session
    if ($_SESSION['role']=="student") {
        header("location: index.php");
        $mysqli->close();
    }
    include "../config.php";
    if(isset($_POST['submit'])){
        $name = $conn->real_escape_string($_POST['name']);
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $id = 0;
        $errorarr = array("<", ">", "(", ")", "/", "\\", "\"", "'", ",");
        // generate id for student table
        $sql = "SELECT MAX(id) as max_id FROM student";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);

        // Set the new ID
        $new_id = $row['max_id'] + 1;
    $q = " INSERT INTO `student`(`id`, `name`, `email`, `phonenumber`) VALUES ('$new_id', '". str_replace($errorarr, "", $name) ."', '". str_replace($errorarr, "", $email) ."', '". str_replace($errorarr, "", $phone) ."')";

        $query = mysqli_query($conn,$q);
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">PHP CRUD OPERATION</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php"><span style="font-size:larger;">Add New</span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 <div class="col-lg-6 m-auto">
 
 <form method="post" onsubmit="return validateForm()">
 
 <br><br><div class="card">
 
 <div class="card-header bg-primary">
 <h1 class="text-white text-center">  Create New Member </h1>
 </div><br>

 <label> NAME: </label>
 <input type="text" name="name" id="name" class="form-control" required> <br>

 <label> EMAIL: </label>
 <input type="text" name="email" id="email" class="form-control" required> <br>

 <label> PHONE: </label>
 <input type="text" name="phone" id="phone" class="form-control" required> <br>

 <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

 </div>
 </form>
 </div>
    <script>
            function validateForm() {
                var username = document.getElementById("name").value;
                var password = document.getElementById("email").value;
                var fullname = document.getElementById("phone").value;

                if (name == "" || email == "" || phone == "") {
                    // Show error message if any field is empty
                    document.getElementById("error-message").style.display = "block";
                    return false;
                } else {
                    return true;
                }
            }
        </script>
</body>
</html>