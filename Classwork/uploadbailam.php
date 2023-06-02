<?php
//html contents
echo file_get_contents('../HTMLfile/trabai.html');

  $target_dir = "trabai/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $baitap = 'baitap';
  
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
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  if(isset($_POST["xembt"])){
    // In tất cả các file có trong folder  
    $dir = 'D:\CodeandPunch\prj\baitap';
    $files1 = array_slice(scandir($dir), 2);
    foreach ($files1 as $value) {
      echo("<a href='$baitap\\$value'>$value</a>")."<br>";
       // echo ("$value")."<br>";
    }
  }
?>
