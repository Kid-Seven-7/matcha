<?php
session_start();

if ($_GET['conn_id']){
  try {
    //Inserting data to the database
    $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT *
                            FROM chats
                            WHERE connection_id = :conn_id");
    $stmt->execute(array(':conn_id' => $_GET['conn_id']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      $send_to = null;
      $i = 0;
      if($row[sent_by] == $_SESSION['username']){
        $send_to = $row[sent_to];
      }else{
        $send_to = $row[sent_by];
      }
      if ($row[sent_by] == $_SESSION['username']){
        echo "<div class='msgBoxSent'><strong>Me:</strong><br> {$row[message]}</div><br>";
      }else{
        echo "<div class='msgBoxReceived'><strong>{$row[sent_by]}:</strong><br> {$row[message]}</div><br>";
      }
      $i++;
    }
    if ($i == 0){
      echo "<div class='msgBoxSent'><strong>Match Bot:</strong><br> You have no messages at present :(</div><br>";
    }
    echo "<form action='includes/sendmsg.php' method='POST'>
      <textarea class='replyBox' name='message' rows='8' cols='80' placeholder='reply'></textarea><br>
      <input type='hidden' name='conn_id' value='{$_GET[conn_id]}'>
      <input type='hidden' name='send_to' value='{$send_to}'>
      <input class='inputButton' type='submit' name='submit' value='reply'>
    </form>";

  }catch(PDOException $e) {
    echo "error: ".$e;
  }
}elseif ($_GET['view']) {
  try {
    $user = $_GET['view'];
    //Inserting data to the database
    $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT *
                            FROM users
                            WHERE user_name = :user_name");
    $stmt->execute(array(':user_name' => $user));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      echo "<div class='suggestions' style='float: left; width:25%'>";
      echo "<a href='checkout.php?user={$row['id']}'><img src='uploads/{$row['profilePic']}'></a>";
      echo "</div>";
      echo "<div style='float:right; width:75%'>";
      echo "<strong>Username:</strong> {$row['user_name']}<br>";
      echo "<strong>Full name:</strong> {$row['first_name']} {$row['surname']}<br>";
      echo "<strong>Age:</strong> {$row['age']}<br>";
      echo "<strong>Bio:</strong> {$row['bio']}<br>";
      echo "<strong>Last seen:</strong> {$row['lastseen']}<br>";
      echo "</div>";
    }
  }catch(PDOException $e) {
    echo "error: ".$e;
  }
}

?>
