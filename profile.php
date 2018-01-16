<?php
session_start();
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
          echo "<h2>$username's profile:</h2>";
          echo "User name: $username<br>";
          echo "email: $email<br>";
          echo "First name: $name<br>";
          echo "About me: $bio<br>";
          echo "Age: $age<br>";
          echo "Gender: $gender<br>";
          echo "Preference: $preference<br>";
          echo "Interests: ";
          foreach ($interests as $interest) {
            if (!$interest == NULL) {
              echo "#$interest ";
            }
          }
          echo "<br>";
          if($age) {
            echo "<a href='geocode.php'>Add location manually</a> or
            <a href='location.php'>Add location automatically</a>";
          }
        ?>
      </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
  </body>
</html>
