<?php
if (isset($_GET["q"])) {
  if ($_GET["q"] == 'teen'){
    $i = 18;
    $j = 20;
  }elseif ($_GET["q"] == 'early_twenties'){
    $i = 20;
    $j = 24;
  }elseif ($_GET["q"] == 'mid_twenties'){
    $i = 24;
    $j = 26;
  }elseif ($_GET["q"] == 'late_twenties'){
    $i = 26;
    $j = 30;
  }elseif ($_GET["q"] == 'early_thirties'){
    $i = 30;
    $j = 34;
  }elseif ($_GET["q"] == 'mid_thirties'){
    $i = 34;
    $j = 36;
  }elseif ($_GET["q"] == 'late_thirties'){
    $i = 36;
    $j = 40;
  }elseif ($_GET["q"] == 'early_fourties'){
    $i = 40;
    $j = 44;
  }elseif ($_GET["q"] == 'mid_fourties'){
    $i = 44;
    $j = 50;
  }
  session_start();
  try {
    $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    while ($i < $j){
      $sql = "SELECT *
              FROM users
              WHERE age = :age";
      $stmt = $conn->prepare($sql);
      $stmt->execute(array(':age' => $i));
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (count($result)) {
        foreach($result as $row) {
          echo "<div class='suggestions'>";
          echo "<a href='checkout.php?user={$row['id']}'><img src='uploads/{$row['profilePic']}'></a>";
          echo "</div>";
        }
      }
      $i++;
    }
  }catch(PDOException $e) {
  echo "error: ".$e;
  }
}

?>
