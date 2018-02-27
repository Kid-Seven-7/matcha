<?php
  session_start();

  if(isset($_GET['remcon']) && $_GET['remcon'] != "null"){
    // Header("location: chat.php");
    $i = 0;
    try {
      //Inserting data to the database
      $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      $stmt = $conn->prepare("UPDATE connections
                              SET seen = 1
                              WHERE user1 = :user
                              AND user2 = :other_user");
      $stmt->execute(array(':user' => $_SESSION['username'], ':other_user' => $_GET['remcon']));

      $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      $stmt = $conn->prepare("UPDATE connections
                              SET seen = 1
                              WHERE user1 = :user
                              AND user2 = :other_user");
      $stmt->execute(array(':other_user' => $_SESSION['username'], ':user' => $_GET['remcon']));
    }catch(PDOException $e) {
      echo "error: ".$e;
    }
    $_GET['remcom'] = "null";
    Header("location: chat.php");
  }

  try {
    //Inserting data to the database
    $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT *
                            FROM connections
                            WHERE user1 = :user
                            AND seen = 0");
    $stmt->execute(array(':user' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      echo "<br><strong>Connections made:</strong><br>";
      foreach($result as $row) {
        echo "you have connected with {$row['user2']}<a href='chat.php?remcon={$row['user2']}'> X</a><br>";
        $i++;
      }
    }

    $stmt = $conn->prepare("SELECT *
                            FROM connections
                            WHERE user2 = :user
                            AND seen = 0");
    $stmt->execute(array(':user' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      if ($i == 0){
        echo "<br><strong>Connections made:</strong><br>";
      }
      foreach($result as $row) {
        echo "you have connected with {$row['user1']}<a href='chat.php?remcon={$row['user1']}'> X</a><br>";
      }
    }


  }catch(PDOException $e) {
    echo "error: ".$e;
  }
?>
