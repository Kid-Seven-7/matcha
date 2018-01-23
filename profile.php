<?php
session_start();
require_once ('config/database.php');

if (isset($_GET['user'])) {
  if (!isset($_SESSION['username'])) {
    echo ("<script>alert('Please login/register first');</script>");
  }
}
if (isset($_GET['avatar'])) {
  echo ("<script>alert('This image has already been uploaded');</script>");
}
$username = $_SESSION['username'];
$email = $_SESSION['email'];
var_dump($_SESSION['latlng']);
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
        echo "<h2>{$username}'s Profile</h2><br>";
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
              echo "<img src='uploads/{$row['profilePic']}' width='200px' height='200px'><br>";
              if(empty($row['user_name'])){
                echo "<strong>Username:</strong> Not set<br>";
              }else{
                echo "<strong>Username:</strong> {$row['user_name']}<br>";
              }
              if(empty($row['first_name'])){
                echo "<strong>Firstname:</strong> Not set<br>";
              }else{
                echo "<strong>Firstname:</strong> {$row['first_name']}<br>";
              }
              if(empty($row['surname'])){
                echo "<strong>Surname:</strong> Not set<br>";
              }else{
                echo "<strong>Surname:</strong> {$row['surname']}<br>";
              }
              if(empty($row['email'])){
                echo "<strong>email:</strong> Not set<br>";
              }else{
                echo "<strong>email:</strong> {$row['email']}<br>";
              }
              if(empty($row['address'])){
                echo "<strong>address:</strong> Not set<br>";
              }else{
                echo "<strong>address:</strong> {$row['address']}<br>";
              }
              if(empty($row['bio'])){
                echo "<strong>Bio:</strong> Not set<br>";
              }else{
                echo "<strong>Bio:</strong> {$row['bio']}<br>";
              }
              if(empty($row['age'])){
                echo "<strong>Age:</strong> Not set<br>";
              }else{
                echo "<strong>Age:</strong> {$row['age']}<br>";
              }
              if(empty($row['gender'])){
                echo "<strong>Gender:</strong> Not set<br>";
              }else{
                echo "<strong>Gender:</strong> {$row['gender']}<br>";
              }
              if(empty($row['preference'])){
                echo "<strong>Preference:</strong> Not set<br>";
              }else{
                echo "<strong>Preference:</strong> {$row['preference']}<br>";
              }
            }
          }
        }catch(PDOException $e) {
          echo "error: ".$e;
        }
        ?>
        <a href="images.php">view profile pictures</a>
      </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
  </body>
</html>
