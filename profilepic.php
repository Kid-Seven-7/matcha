<?php
session_start();

if (isset($_POST['submit'])){
  if($_FILES['image']['name']){
    $fileName = $_FILES['image']['name'];
    $_SESSION['filename'] = $fileName;
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

      if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
          if($filesize < 1000000){
            // $fileNameNew = uniqid('', true). ".".$fileActualExt;
            $fileDestination ='uploads/'.$fileName;
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


?>

<!DOCTYPE html>
<html>

  <head>
    <?php include_once'includes/meta.php' ?>
    <title></title>
  </head>
  <?php include_once'includes/header.php' ?>
  <body>
    <div class="profilePic">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" value="" />
        <br><br>
        <button type="submit" name="submit">Upload</button>
      </form>
    </div>
    <?php ($fileDestination); ?>
    <div id="image">
      <?php
        if(!empty($_FILES['image']['name'])){
          echo "<h3>preview</h3><br>";
        }
       ?>
      <img src="<?php echo $fileDestination ?>" alt="" width="400px" height="400px">
      <?php
        if(!empty($_FILES['image']['name'])){
          echo "
          <form class='' action='includes/setprofile.php' method='post'>
            <button type='submit' name='submit' formaction='includes/setprofile.php'>Save</button>
          </form>
          ";
        }
       ?>
    </div>
  </body>
</html>
