
<?php include_once 'includes/header.php' ?>
<?php
session_start();
try {
  $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if($_SESSION['preference'] == 'male'){
    $sql = "SELECT *
            FROM users
            WHERE gender='male'";
  }elseif ($_SESSION['preference'] == 'female') {
    $sql = "SELECT *
            FROM users
            WHERE gender='female'";
  }else{
    $sql = "SELECT *
            FROM users";
  }

  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result)) {
    foreach($result as $row) {
      if ($row['user_name'] != $_SESSION['username']){
        echo "<div class='suggestions'>";
        echo "<a href='checkout.php?user={$row['id']}'><img alt='{$row['user_name']}' title='{$row['user_name']}' src='uploads/{$row['profilePic']}'></a>";
        echo "</div>";
      }
    }
  }
}catch(PDOException $e) {
  echo "error: ".$e;
}
