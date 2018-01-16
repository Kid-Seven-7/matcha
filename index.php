<?php
session_start();

  if (isset($_GET['signup']) && $_GET['signup'] == "u_name") {
    echo ("<script>alert('Username is not available')</script>");
  }
  else if (isset($_GET['signup']) && $_GET['signup'] == "email") {
    echo ("<script>alert('The email entered has been used before')</script>;");
  }
  else if (isset($_GET['signup']) && $_GET['signup'] == "username") {
    echo ("<script>alert('Username not available. Choose another one')</script>;");
  }
  else if (isset($_GET['code']) && $_GET['code'] == -1) {
    echo ("<script>alert('Error: Code is invalid')</script>;");
  }
  else if (isset($_GET['signup']) && $_GET['signup'] == "empty") {
    echo ("<script>alert('Required fields are empty')</script>;");
  }
  else if (isset($_GET['verify']) && $_GET['verify'] == 0) {
    echo ("<script>alert('A verification link has been sent to your email')</script>");
  }
  else if (isset($_GET['signup']) && $_GET['signup'] == "invalid") {
    echo "<script>alert('Invalid username entered');</script>";
  }
  else if (isset($_GET['forgot']) && $_GET['forgot'] == 1) {
    echo ("<script>alert('A reset link has been sent to your email');</script>");
  }
  else if (isset($_GET['pas']) && $_GET['pas'] == "weak") {
    echo ("<script>alert('Password too short. Password must be 8 or more characters, have atleast one lowercase and one uppercase letter');</script>");
  }
  else if (isset($_GET['con'])) {
    echo ("<script>alert('Connection to the server failed');</script>");
  }
  else if (isset($_GET['user']) && $_GET['user'] == "log") {
    if (!isset($_SESSION['username'])) {
      //sign in please
      echo ("<script>alert('Please login/register first');</script>");
    }
    else {
      session_destroy();
      echo ("<script>alert('Logged out successfully');</script>");
    }
  }
  else if (isset($_SESSION['email']) && $_SESSION['email'] != "") {
    require_once('config/database.php');

    $user = $_SESSION['email'];

    try {
      $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
      $stmt->execute(array(':email' => $user));

      $result = $stmt->fetchAll();
      if (count($result)) {
        foreach($result as $row)
        if ($row['email'] == $user) {
          header("Location: cam.php");
          exit();
        }
        else {
          session_destroy();
          header("Location: index.php");
          exit();
        }
      }
      else {
        session_destroy();
        header("Location: index.php");
        exit();
      }
    }
    catch(PDOExceptio $e) {
      echo "<script>alert('Error trying to connect to server. Check your internet connection')</script>";
      session_destroy();
    }
  }

?>

<!DOCTYPE html>
<html >
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Registeration</title>
  </head>

  <body>
    <div class="MainContainer">
      <div class="HeaderClass">
        <?php include_once 'includes/header.php' ?>
      </div>
      <div class="regformClass">
        <?php include_once 'includes/regform.php' ?>
      </div>
      <div class="profiles">
        <?php include_once 'includes/search.php' ?>
      </div>
      <div class="FooterClass">
        <?php include_once 'includes/footer.php' ?>
      </div>
      </div>
  </body>
</html>
