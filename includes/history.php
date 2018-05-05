<?php
  session_start();
  require_once('config/database.php');
  if (isset($_GET['remview'])){
    try {
      $user = $_GET['view'];
      //Inserting data to the database
      $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("UPDATE history
                              SET seen = 1
                              WHERE id = :id");
      $stmt->execute(array(':id' => $_GET['remview']));
    }catch(PDOException $e) {
      echo "error: ".$e;
    }
  }
  try {
    //Inserting data to the database
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Checking for profiles the user has looked at
    $stmt = $conn->prepare("SELECT *
                            FROM history
                            WHERE viewer = :liker
                            AND seen = 0");
    $stmt->execute(array(':liker' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<br><strong>People that you have checked out:</strong><br>";
      foreach($result as $row) {
        echo "<a href='chat.php?remview={$row['id']}'>X </a>{$row['view']}<br>";
      }
    }
    // Checking for profiles that have liked the user
    $stmt = $conn->prepare("SELECT *
                            FROM history
                            WHERE view = :likee
                            AND seen = 0");
    $stmt->execute(array(':likee' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<br><strong>People that have checked you out:</strong><br>";
      foreach($result as $row) {
        echo "<a href='chat.php?remview={$row['id']}'>X </a>{$row['viewer']}<br>";
      }
    }
  }catch(PDOException $e) {
    echo "error: ".$e;
  }
?>
