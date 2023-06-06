<?php
  $baitap = 'baitap';
  $creatbutomm1 = '<form action="" method="post">
  <input type="submit" value="Làm Bài" name="lambai">
  </form>' ;
  
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
  // In tất cả các file có trong folder  
  if(isset($_POST["xembt"])){
			$files = glob("baitap/*.*");
			foreach ($files as $file) {
				echo "<li><a href='download.php?file=$file'>" . basename($file) . "</a></li>";
        echo $creatbutomm1 ;
			}
    // $dir = 'D:\CodeandPunch\prj\baitap';
    // $files1 = array_slice(scandir($dir), 2);
    // foreach ($files1 as $value) {
    //   echo("<a href='$baitap\\$value'>$value</a>")."<br>";
    //   echo $creatbutomm1 ;
    //   echo ("$value")."<br>";
    // }
  }
  if(isset($_POST["lambai"])){
    header("Location: trabai.html");
  }
  
?>
