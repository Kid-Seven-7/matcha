<?php

try {
  $i = 0;
  //Inserting data to the database
  $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $stmt = $conn->prepare("SELECT *
                          FROM chats
                          WHERE sent_to = :user
                          AND opened = 0");
  $stmt->execute(array(':user' => $_SESSION['username']));
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result as $row) {
    echo "{$row[sent_by]}:<br> {$row[message]}<br><textarea placeholder='reply' rows='7' cols='30'></textarea>";
    $i++;
  }

}catch(PDOException $e) {
  echo "error: ".$e;
}

?>
