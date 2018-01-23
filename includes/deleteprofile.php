<?php
// TODO
// try {
//   session_start();
//   include_once 'config/database.php';
//   var_dump($_SESSION['email']);
//   var_dump($_SESSION['username']);
//   $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//   $stmt = $conn->prepare("DELETE
//                           FROM users
//                           WHERE email = $_SESSION['email']");
//   $stmt->execute();
// }catch(PDOException $e) {
//   header("Location: index.php");
//   echo "Error: {$e}";
// }

// try {
//   $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//   $stmt = $conn->prepare("DELETE
//                           FROM pictures
//                           WHERE user = :user");
//   $stmt->execute(array(':user' => $_SESSION['username']));
// }catch(PDOException $e) {
//   echo "Error: {$e}";
// }

?>
