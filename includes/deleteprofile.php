<?php
echo "string";
  session_start();
  include_once '../config/database.php';
  $name = $_SESSION['username'];
  try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("DELETE FROM users
                            WHERE user_name = $name");
    $stmt->execute(;

  }catch(PDOException $e) {
    echo "Error: {$e}";
  }

  // header("Location: ../index.php");

?>
