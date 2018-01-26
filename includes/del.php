<?php
session_start();
$email = $_SESSION['email'];

try {
  $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if($_GET['rem'] == 'tattoos'){
    $sql = "UPDATE users
    SET Tattoos=0
    WHERE email='$email'";
    var_dump($email);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'piercings'){
    $sql = "UPDATE users
    SET Piercings=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'music'){
    $sql = "UPDATE users
    SET Music=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'art'){
    $sql = "UPDATE users
    SET Art=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'gaming'){
    $sql = "UPDATE users
    SET Gaming=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'cooking'){
    $sql = "UPDATE users
    SET Cooking=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'anime'){
    $sql = "UPDATE users
    SET Anime=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'cycling'){
    $sql = "UPDATE users
    SET Cycling=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'sports'){
    $sql = "UPDATE users
    SET Sports=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'fitness'){
    $sql = "UPDATE users
    SET Fitness=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'pets'){
    $sql = "UPDATE users
    SET Pets=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
  if($_GET['rem'] == 'nature'){
    $sql = "UPDATE users
    SET Nature=0
    WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: ../profile.php");
  }
}catch(PDOException $e) {
  echo "error: ".$e;
}


?>
