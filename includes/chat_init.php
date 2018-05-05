<?php
include ("config/database.php");


$match_bot = "match bot";
$sent = date("Y-m-d h:i:s");
$msg = "A new connection has been formed, you may now send DM's"

try{
  $stmt = $conn->prepare("SELECT *
                          FROM connections
                          WHERE user1 = :user
                          AND seen = 0");
  $stmt->execute(array(':user' => $_SESSION['username']));
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result)) {
    $conn_id = $result['id']
    $stmt = $conn->prepare("INSERT INTO chats (sent_to, sent_by, message, sent_on, connection_id)
                            VALUES(:user, :match_bot, :msg, :sent_on, connection_id)");
    $stmt->execute(array(':user' => $_SESSION['username'],
                          ':match_bot' => $match_bot,
                          ':msg' => $msg,
                          ':sent_on' => $sent,
                          ':connection_id' => $conn_id));
  }else{
    $stmt = $conn->prepare("SELECT *
                            FROM connections
                            WHERE user2 = :user
                            AND seen = 0");
    $stmt->execute(array(':user' => $_SESSION['username']));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result)) {
      $conn_id = $result['id']
      $stmt = $conn->prepare("INSERT INTO chats (sent_to, sent_by, message, sent_on, connection_id)
                              VALUES(:user, :match_bot, :msg, :sent_on, connection_id)");
      $stmt->execute(array(':user' => $_SESSION['username'],
                            ':match_bot' => $match_bot,
                            ':msg' => $msg,
                            ':sent_on' => $sent,
                            ':connection_id' => $conn_id));
    }
  }
}catch(PDOException $e){

}

?>
