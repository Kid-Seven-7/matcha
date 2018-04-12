
<?php include_once 'includes/header.php' ?>
<?php include_once 'config/database.php' ?>
<?php
try {
  $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  // $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if(isset($_SESSION['preference']) && $_SESSION['preference'] == 'male'){
    $sql = "SELECT *
            FROM users
            WHERE gender='male'";
  }elseif (isset($_SESSION['preference']) && $_SESSION['preference'] == 'female') {
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
