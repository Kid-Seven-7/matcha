<?php

session_start();

try {
  $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("INSERT INTO pictures (name, user, current)
    VALUES (:name, :user, :current)");
  var_dump($_SESSION['username']);
  // var_dump();
  $stmt->execute(array(':name' => $_SESSION['filename'], ':user' => $_SESSION['username'], ':current' => 1));
} catch(PDOException $e) {
  echo "Unable to add picture to table: $e";
}

?>
