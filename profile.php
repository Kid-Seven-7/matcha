<?php
session_start();
require_once ('config/database.php');

if (isset($_GET['user'])) {
  if (!isset($_SESSION['username'])) {
    echo ("<script>alert('Please login/register first');</script>");
  }
}
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Profile Page</title>
  </head>
  <body>
    <?php include_once 'includes/header.php' ?>

    <div class="profile container">
      <div class="UpdateForm">
        <?php include_once 'includes/update.php' ?>
      </div>

      <div class="FormFeedback">
        <?php
        try {
          $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $sql = "SELECT *
                  FROM users
                  WHERE email='$email'";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if (count($result)) {
            foreach($result as $row) {
              if(empty($row['user_name'])){
                echo "Username: Not set<br>";
              }else{
                echo "Username: {$row['user_name']}<br>";
              }
              if(empty($row['first_name'])){
                echo "Firstname: Not set<br>";
              }else{
                echo "Firstname: {$row['first_name']}<br>";
              }
              if(empty($row['surname'])){
                echo "Surname: Not set<br>";
              }else{
                echo "Surname: {$row['surname']}<br>";
              }
              if(empty($row['email'])){
                echo "email: Not set<br>";
              }else{
                echo "email: {$row['email']}<br>";
              }
              if(empty($row['bio'])){
                echo "Bio: Not set<br>";
              }else{
                echo "Bio: {$row['bio']}<br>";
              }
              if(empty($row['age'])){
                echo "Age: Not set<br>";
              }else{
                echo "Age: {$row['age']}<br>";
              }
              if(empty($row['gender'])){
                echo "Gender: Not set<br>";
              }else{
                echo "Gender: {$row['gender']}<br>";
              }
              if(empty($row['preference'])){
                echo "Preference: Not set<br>";
              }else{
                echo "Preference: {$row['preference']}<br>";
              }
            }
          }
        }
        catch(PDOException $e) {
          echo "error: ".$e;
        }
        ?>
      </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
  </body>
</html>
