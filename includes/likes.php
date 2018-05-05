<?php
  session_start();
  include_once '../config/database.php';

  if (isset($_GET['remlike'])){
    try {
      $user = $_GET['view'];
      //Inserting data to the database
      $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      $stmt = $conn->prepare("UPDATE likes
                              SET seen = 1
                              WHERE id = :id");
      $stmt->execute(array(':id' => $_GET['remlike']));
    }catch(PDOException $e) {
      echo "error: ".$e;
    }
  }
  try {
    //Inserting data to the database
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Checking for profiles the user has liked
    $stmt = $conn->prepare("SELECT *
                            FROM likes
                            WHERE liker = :liker
                            AND seen = 0");
    $stmt->execute(array(':liker' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<br><strong>People that you have liked:</strong><br>";
      foreach($result as $row) {
        echo "<a href='chat.php?remlike={$row['id']}'>X </a>{$row['likee']}<br>";
      }
    }

    // Checking for profiles that have liked the user
    $stmt = $conn->prepare("SELECT *
                            FROM likes
                            WHERE likee = :likee
                            AND seen = 0");
    $stmt->execute(array(':likee' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<br><strong>People that have liked you:</strong><br>";
      foreach($result as $row) {
        echo "<a href='chat.php?remlike={$row['id']}'>X </a><a href='chat.php?view={$row['liker']}'> {$row['liker']} </a><br>";
      }
    }

  }catch(PDOException $e) {
    echo "error: ".$e;
  }
?>
