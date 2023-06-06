<?php
$baitap = 'baitap';
$trabai = 'trabai';
$creatbutomm2 ='<form action="" method="post">
<input type="submit" value="Download" name="taixuong">
<input type="submit" value="Xem Bài Làm" name="xembl">
</form>' ;

  if(isset($_POST["thembt"])){
    header("Location: giaobai.html");
  }

  if(isset($_POST["submit"])){
    $target_dir = "baitap/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Kiểm Tra Xem File Đã Tồn Tại Hay Chưa
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Nếu File Tải Lên Đã Tồn Tại Sẽ Không Tải Lên Nữa
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // Ngược Lại Thì Cho Tải Lên
    } 
    else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } 
      else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
  if(isset($_POST["xemds"])){
    // In tất cả các file có trong folder  
    $dir1 = 'D:\CodeandPunch\prj\baitap';
    $files1 = array_slice(scandir($dir1), 2);
    foreach ($files1 as $value) {
      echo("<a href='$baitap\\$value'>$value</a>")."<br>";
      echo $creatbutomm2;
      // echo ("$value")."<br>";
    }
  }
  if(isset($_POST["xembl"])){
    $dir2 = 'D:\CodeandPunch\prj\trabai';
    $files2 = array_slice(scandir($dir2), 2);
    foreach ($files2 as $value) {
      echo("<a href='$trabai\\$value'>$value</a>")."<br>";
      // echo ("$value")."<br>";
    }
  }
    
?>

