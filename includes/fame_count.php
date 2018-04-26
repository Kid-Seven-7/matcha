<?php
session_start();
require_once('../config/database.php');

$name = $_SESSION['username'];
try {
  $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare('SELECT *
                          FROM likes
                          WHERE likee = :likee');
  $stmt->execute(array(':likee' => $name));

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($result)) {
    $likes = 0;
    foreach($result as $row) {
      $likes++;
    }
    $sql = "UPDATE users
            SET fame=$likes
            WHERE user_name='$name'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
  }
}catch(PDOExceptio $e) {
  echo "error";
}

Header("location: ../cam.php")
?>
