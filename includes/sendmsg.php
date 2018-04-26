<?php
session_start();

if (isset($_POST['submit'])){
  $msg = $_POST['message'];
  $send_to = $_POST['send_to'];
  $conn_id = $_POST['conn_id'];
  $sent_by = $_SESSION['username'];

  if (empty($msg)){
    header("Location: ../chat.php?msg=empty");
  }else if(empty($conn_id)){
    header("Location: ../chat.php?conn_id=empty");
  }

  try{
    $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("INSERT INTO chats (sent_to, sent_by, message, sent_on, opened, connection_id)
                            VALUES (:send_to, :sent_by, :message, :sent_on, :opened, :conn_id)");
    $stmt->execute(array(':send_to' => $send_to,
                          ':sent_by' => $sent_by,
                          ':message' => $msg,
                          'sent_on' => date("Y-m-d h:i:s"),
                          'opened' => 0,
                          ':conn_id' => $conn_id));
  }catch(PDOException $e){
    echo "error: {$e}";
  }

}

header("Location: ../chat.php?conn_id={$conn_id}")

?>
