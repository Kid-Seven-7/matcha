<?php
session_start();
include_once ('../config/database.php');

try {

  //Inserting data to the database
  $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Checking to see if there is a connection to be made
  $stmt = $conn->prepare("DELETE FROM likes
                          WHERE likee = :likee
                          AND liker = :liker");
  $stmt->execute(array(':likee' => $_SESSION['checkingout'], ':liker' => $_SESSION['username']));

}catch(PDOException $e) {
  echo "error: ".$e;
}

Header("location: fame_count.php")
// Header("location: ../cam.php")
?>
