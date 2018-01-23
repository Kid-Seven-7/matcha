
<?php
session_start();
if (isset($_GET["upload"]) && ($_GET["upload"] == "successful")){
  echo ("<script>alert('Your upload was successful')</script>");
}

if (isset($_POST['submit'])){
  if($_FILES['image']['name']){
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    echo "file name: {$fileName}<br>";
    echo "file tmp name: {$fileTmpName}<br>";
    echo "file size: {$fileSize}<br>";
    echo "file error: {$fileError}<br>";
    echo "file type: {$fileType}<br>";

    echo "username: {$_SESSION['username']}<br>";
    echo "email: {$_SESSION['email']}<br>";
    VAR_DUMP($_SESSION);

    $fileExt = explode('.', $fileName);
    echo "file ext: {$fileExt[1]}<br>";
    $fileActualExt = strtolower(end($fileExt));
    echo "file act ext: {$fileActualExt}<br>";

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt, $allowed)){
      if($fileError === 0){
        if($filesize < 1000000){
          // $fileNameNew = uniqid('', true). ".".$fileActualExt;
          $fileDestination ='../uploads/'.$fileName;
          move_uploaded_file($fileTmpName, $fileDestination);

          // try {
          //   $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
          //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //
          //   //Preparing query
          //   $stmt = $conn->prepare('INSERT INTO pictures (name, user, type, ext)
          //     VALUES (:fileName, );'
          //   );
          //   //executing the query
          //   $stmt->execute(array('filename' => $fileName));
          // }
          // catch(PDOException $e) {
          //   echo "Unable to create picture table";
          //   echo "ERROR: ".$e->getMessage()."<br/>";
          // }

          // header("Location: upload.php?upload=successful");
        }else{
          echo "Your file is too big";
        }
      }else{
        echo "There was an error uploading your file";
      }
    }else{
      echo "You cannot upload files of this type";
    }
  }
}
