<?php
  session_start();
  try {
    //Inserting data to the database
    $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT *
                            FROM likes
                            WHERE liker = :liker");
    $stmt->execute(array(':liker' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<strong>People that you have liked:</strong><br>";
      foreach($result as $row) {
        echo "you liked {$row['likee']}<br>";
      }
    }

    $stmt = $conn->prepare("SELECT *
                            FROM likes
                            WHERE likee = :likee");
    $stmt->execute(array(':likee' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<strong>People that have liked you:</strong><br>";
      foreach($result as $row) {
        echo "{$row['liker']} liked you<br>";
      }
    }

  }catch(PDOException $e) {
    echo "error: ".$e;
  }
?>
