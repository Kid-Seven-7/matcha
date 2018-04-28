
<?php include_once 'config/database.php' ?>
<?php

function printResult($row){
  if(isset($_SESSION['age_range'])){
    $range = $_SESSION['age_range'];
  }
  if(isset($_SESSION['interests']) && $range){
    foreach ($_SESSION['interests'] as $interest){
      if($row[$interest] == 1 && $_SESSION['age_range'] >= $row['age']){
        echo "<div class='suggestions'>";
        echo "<a href='checkout.php?user={$row['id']}'><img alt='{$row['user_name']}' title='{$row['user_name']}' src='uploads/{$row['profilePic']}'></a>";
        echo "</div>";
        break;
      }
    }
  }elseif(isset($_SESSION['interests'])){
    foreach ($_SESSION['interests'] as $interest){
      if($row[$interest] == 1){
        echo "<div class='suggestions'>";
        echo "<a href='checkout.php?user={$row['id']}'><img alt='{$row['user_name']}' title='{$row['user_name']}' src='uploads/{$row['profilePic']}'></a>";
        echo "</div>";
        break;
      }
    }
  }
}

try {
  $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
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
        printResult($row);
      }
    }
  }
  $_SESSION['interests'] = null;
}catch(PDOException $e) {
  echo "error: ".$e;
}
