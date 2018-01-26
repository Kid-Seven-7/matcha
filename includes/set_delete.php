<?php
session_start();

if(isset($_GET['del'])){
  $image = $_GET['del'];

  try {
    $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Anding image to database
    $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("DELETE
                            FROM pictures
                            WHERE name = :filename
                            And user = :username");
    $stmt->execute(array(':filename' => $image, ':username' => $_SESSION['username']));
    header("Location: images.php")
    echo "<script>alert('Image deleted successfully')</script>";
  }catch(PDOException $e) {
    echo "Unable to delete image: $e";
  }
}elseif(isset($_GET['set'])){
  $image = $_GET['set'];

  try {
      // Anding image to database
    $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("UPDATE users
                            SET profilepic = $name
                            WHERE email = :email");
    $stmt->execute(array(':email' => $_SESSION['email']));
    header("Location: images.php")
    echo "<script>alert('Profile picture set successfully')</script>";
  }catch(PDOException $e) {
    echo "Unable to set profile picture: $e";
  }
}

?>
