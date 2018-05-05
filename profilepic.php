<?php
session_start();

include ("config/database.php");

if (isset($_POST['submit'])){
  if($_FILES['image']['name']){
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt, $allowed)){
      if($fileError === 0){
        if($fileSize < 1000000){
          // $fileNameNew = uniqid('', true). ".".$fileActualExt;
          $fileDestination ='uploads/'.$fileName;
          $_SESSION['profilePic'] = $fileName;
          move_uploaded_file($fileTmpName, $fileDestination);

          try {
            // Check for duplicate files
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $conn->prepare("SELECT name, user, current
                                      FROM pictures
                                      WHERE name='{$fileName}'
                                      AND user='{$_SESSION['username']}'");
            $result->execute();

            // Check for 5 pic limit
            //TODO
            $i = 0;
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $conn->prepare("SELECT *
                                      FROM pictures
                                      WHERE user='{$_SESSION['username']}'");
            $result->execute();
            $j = count($result);
            foreach ($result as $key) {
              $i++;
            }

            echo "i is :{$i}";

            // Anding image to database
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO pictures (name, user, current)
                                    VALUES (:name, :user, :current)");
            $stmt->execute(array(':name' => $fileName, ':user' => $_SESSION['username'], ':current' => 1));
          }catch(PDOException $e) {
            echo "Unable to add picture to table: $e";
          }
        }else{
          echo "Your file is too big";
        }
      }else{
        echo "There was an error uploading your file";
      }
    }else{
      echo "Format not supported";
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
      <br><br>
      <?php ($fileDestination); ?>
      <div id="image">
        <?php
          if(!empty($_FILES['image']['name'])){
            echo "<a href='includes/setprofile.php'>set as profilePic</a><br>";
          }
        ?>
        <img src="<?php echo $fileDestination ?>" alt="" width="400px" height="400px">
      </div>
    </div>
  </body>
</html>
