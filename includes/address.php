<?php
session_start();

$address = $_GET['address'];
$latlng = $_GET['latlng'];
$email = $_SESSION['email'];


if(isset($_GET['latlng'])){
  $_SESSION['latlng'] = $_GET['latlng'];
  header("Location: ../profile.php");
}

try {
  $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE users SET address = :address WHERE email = :email";

  $stmt = $conn->prepare($sql);
  $stmt->execute(array(':address' => $address, ':email' => $email));
}
catch(PDOException $e) {
  echo "error: ".$e;
}
// header("Location: ../profile.php");
?>
