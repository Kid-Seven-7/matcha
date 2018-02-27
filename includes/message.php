<?php
  session_start();
  try {
    $i = 0;
    //Inserting data to the database
    $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT *
                            FROM connections
                            WHERE user1 = :user");
    $stmt->execute(array(':user' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<br><strong>Connections:</strong><br>";
      foreach($result as $row) {
        echo "<a href='chat.php?conn_id={$row['id']}'>{$row['user2']}</a><br>";
        $i++;
      }
    }

    $stmt = $conn->prepare("SELECT *
                            FROM connections
                            WHERE user2 = :user");
    $stmt->execute(array(':user' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      if ($i = 0){
        echo "<br><strong>Connections:</strong><br>";
      }
      foreach($result as $row) {
        echo "<a href='chat.php?conn_id={$row['id']}'>{$row['user1']}</a><br>";
      }
    }
  }catch(PDOException $e) {
    echo "error: ".$e;
  }
?>
