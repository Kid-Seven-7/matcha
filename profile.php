<?php
session_start();
if (isset($_GET['user'])) {
  if (!isset($_SESSION['username'])) {
    echo ("<script>alert('Please login/register first');</script>");
  }
}
$name = $_SESSION['username'];
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
    <div class="UpdateForm">
      <?php include_once 'includes/update.php' ?>
    </div>
    <div class="profile">
      <?php echo ("<p>username: $name</p>") ?>
      <?php echo ("<p>email: $email</p>") ?>
    </div>
    <?php include_once 'includes/footer.php' ?>
  </body>
</html>
