<?php
if (isset($_GET["q"])) {
  if ($_GET["q"] == 'male'){
    $var = 'male';
  }elseif ($_GET["q"] == 'female'){
    $var = 'female';
  }else{
    $var = '*';
  }
  session_start();
  try {
    $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    while ($i < $j){
      $sql = "SELECT *
              FROM users
              WHERE gender = :gender";
      $stmt = $conn->prepare($sql);
      $stmt->execute(array(':gender' => $var));
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (count($result)) {
        foreach($result as $row) {
          var_dump($row);
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
