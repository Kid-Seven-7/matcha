<?php
session_start();

$user = $_SESSION['username'];

try{
  $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if($_GET['del']){
    $image = $_GET['del'];
    $stmt = $conn->prepare("DELETE FROM pictures
                            WHERE name = :pic
                            AND user = :username");
  }
  elseif($_GET['set']){
    $image = $_GET['set'];
    $stmt = $conn->prepare("UPDATE users
                            SET profilepic = :pic
                            WHERE user_name = :username");
  }

  $stmt->execute(array(':pic' => $image, ':username' => $user));
  header("Location: ../images.php");

}catch(PDOException $e){
  echo "Unable to delete image: $e";
}

?>
