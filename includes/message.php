<?php
  session_start();
  try {
    //Inserting data to the database
    $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT *
                            FROM connections
                            WHERE user1 = :user");
    $stmt->execute(array(':user' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<strong>Connections:</strong><br>";
      foreach($result as $row) {
        echo "chat with {$row['user2']}<br>";
      }
    }

    $stmt = $conn->prepare("SELECT *
                            FROM connections
                            WHERE user2 = :user");
    $stmt->execute(array(':user' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<strong>Connections made:</strong><br>";
      foreach($result as $row) {
        echo "chat with {$row['user1']}<br>";
      }
    }


  }catch(PDOException $e) {
    echo "error: ".$e;
  }
?>
