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
          echo "<h2>$username's input:</h2>";
          echo "User name: ";
          echo $username;
          echo "<br>";
          echo "email: ";
          echo $email;
          echo "<br>";
          echo "First name: ";
          echo $first_name;
          echo "<br>";
          echo "About me: ";
          echo $bio;
          echo "<br>";
          echo "Age: ";
          echo $age;
          echo "<br>";
          echo "Gender: ";
          echo $gender;
          echo "<br>";
          echo "Preference: ";
          echo $preference;
          echo "<br>";
          echo "Interests: ";
          foreach ($interests as $interest) {
            if (!$interest == NULL) {
              echo "#$interest ";
            }
          }
        ?>
      </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
  </body>
</html>
