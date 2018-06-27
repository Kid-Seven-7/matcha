<?php

session_start();

try {
  $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("UPDATE users
    SET profilePic = '{$_SESSION['profilePic']}'
    WHERE user_name = '{$_SESSION['username']}'");
  $stmt->execute();
} catch(PDOException $e) {
  echo "Unable to add picture to table: $e";
}
header("Location: ../profile.php");
?>
