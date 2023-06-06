<?php
  $target_dir = "trabai/";
  $target_file = $target_dir . basename($_FILES["Upload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// tải file lên
  if(isset($_POST["submit"])){
      // Kiểm Tra Xem File Đã Tồn Tại Hay Chưa
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Nếu File Tải Lên Đã Tồn Tại Sẽ Không Tải Lên Nữa
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // Ngược Lại Thì Cho Tải Lên
    } else {
      if (move_uploaded_file($_FILES["Upload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["Upload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
?>