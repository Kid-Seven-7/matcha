<?php
session_start();
include_once ('../config/database.php');

try {

  //Inserting data to the database
  $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Checking to see if there is a connection to be made
  $stmt = $conn->prepare("SELECT *
                          FROM likes
                          WHERE likee = :likee
                          AND liker = :liker");
  $stmt->execute(array(':likee' => $_SESSION['username'], ':liker' => $_SESSION['checkingout']));

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Making connection
  if (count($result)) {
    $stmt = $conn->prepare("INSERT INTO connections (user1, user2)
                            VALUES(:likee, :liker)");

    $stmt->execute(array(':likee' => $_SESSION['checkingout'], ':liker' => $_SESSION['username']));

  }else {

    // Adding like to likes table
    $stmt = $conn->prepare("INSERT INTO likes (likee, liker)
                            VALUES(:likee, :liker)");

    $stmt->execute(array(':likee' => $_SESSION['checkingout'], ':liker' => $_SESSION['username']));
  }
}catch(PDOException $e) {
  echo "error: ".$e;
}

Header("location: fame_count.php")
?>
