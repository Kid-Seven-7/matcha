<?php
  session_start();

  $timestamp = date("Y-m-d H:i:s");

  var_dump($timestamp);

  // try {
  //   $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
  //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //
  //   $sql = "UPDATE users
  //   SET lastseen='$timestamp'
  //   WHERE email='$_SESSION['email']'";
  //   $stmt = $conn->prepare($sql);
  //   $stmt->execute();
  //
  // }catch(PDOException $e) {
  //   echo "error: ".$e;
  // }

  $_SESSION = array();
  session_destroy();
  header("Location: ../index.php?reset=1");
?>
