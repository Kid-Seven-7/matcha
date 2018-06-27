
<?php include_once 'includes/header.php' ?>
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
				echo "<div class='userImage'>";
				echo "<a href='checkout.php?user={$row['id']}'><img alt='{$row['user_name']}' title='{$row['user_name']}' src='uploads/{$row['profilePic']}'></a>";
				echo "</div>";
	        echo "<div class='userInfo'>";
					echo "<strong>Username</strong>: {$row['user_name']}<br>";
					echo "<strong>Age</strong>: {$row['age']}<br>";
					echo "<strong>Fame rating</strong>: {$row['fame']}<br>";
					echo "<strong>Bio</strong>: {$row['bio']}<br>";
					$seen = explode(" ", $row['lastseen']);
					$time = explode(".", $seen[1]);
					$current = date("Y-m-d");
					if ($current == $seen[0]){
						echo "<strong>Lastseen</strong>: on Today @ {$time[0]}<br>";
					}
					else{
						echo "<strong>Lastseen</strong>: on {$seen[0]} @ {$time[0]}<br>";
					}
					echo "</div>";
        echo "</div>";
        break;
      }
    }
  }elseif(isset($_SESSION['interests'])){
    foreach ($_SESSION['interests'] as $interest){
      if($row[$interest] == 1){
				echo "<div class='suggestions'>";
				echo "<div class='userImage'>";
				echo "<a href='checkout.php?user={$row['id']}'><img alt='{$row['user_name']}' title='{$row['user_name']}' src='uploads/{$row['profilePic']}'></a>";
				echo "</div>";
	        echo "<div class='userInfo'>";
					echo "<strong>Username</strong>: {$row['user_name']}<br>";
					echo "<strong>Age</strong>: {$row['age']}<br>";
					echo "<strong>Fame rating</strong>: {$row['fame']}<br>";
					echo "<strong>Bio</strong>: {$row['bio']}<br>";
					$seen = explode(" ", $row['lastseen']);
					$time = explode(".", $seen[1]);
					$current = date("Y-m-d");
					if ($current == $seen[0]){
						echo "<strong>Lastseen</strong>: on Today @ {$time[0]}<br>";
					}
					else{
						echo "<strong>Lastseen</strong>: on {$seen[0]} @ {$time[0]}<br>";
					}
					echo "</div>";
        echo "</div>";
        break;
      }
    }
  }
}

try {
  $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if($_SESSION['sort_by'] && $_SESSION['sort_in'] == "ASC"){
		$diff = "ORDER BY {$_SESSION['sort_by']} ASC";
	}else{
		$diff = "ORDER BY {$_SESSION['sort_by']} DESC";
	}
  if(isset($_SESSION['preference']) && $_SESSION['preference'] == 'male'){
    $sql = "SELECT *
            FROM users
            WHERE gender='male'
						$diff";
  }elseif (isset($_SESSION['preference']) && $_SESSION['preference'] == 'female') {
    $sql = "SELECT *
            FROM users
            WHERE gender='female'
						$diff";
  }else{
    $sql = "SELECT *
            FROM users
						$diff";
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
  // echo "error: ".$e;
}
