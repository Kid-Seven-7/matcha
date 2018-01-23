<?php

require_once('config/database.php');

if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    echo ("<script>alert('A reset link has been sent your email')</script>");
}elseif (isset($_GET['email_not_found'])) {
  echo ("<script>alert('This is not a registered email. Please register first');</script>");
}elseif (isset($_GET['con']) && $_GET['con'] == "error") {
  echo ("<script>alert('Connection to the server failed');</script>");
}elseif (isset($_GET['verify']) && $_GET['verify'] == -1) {
  echo ("<script>alert('This account is not yet varified');</script>");
}elseif (isset($_GET['email'])) {
  echo ("<script>alert('Enter your email to get a reset link');</script>");
}elseif (isset($_GET['email_not_found'])) {
  echo ("<script>alert('This is not a registered email. Please register to get an account');</script>");
}elseif (isset($_GET['con']) && $_GET['con'] == "error") {
  echo ("<script>alert('Connection to the server failed');</script>");
}elseif (isset($_GET['code']) && $_GET['code'] == -1) {
  echo ("<script>alert('Invalid code entered. To reset your account enter your email and submit');</script>");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Reset Password</title>
  </head>
  <body>
    <?php include_once 'includes/header.php' ?>
    <script>
      function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
          x.className += " responsive";
        }
        else {
          x.className = "topnav";
        }
      }
    </script>
    <div>
      <div class="RegForm">
        <div>
          <h2>Enter your email</h2>
          <form action="config/forgot.inc.php" method="POST">
            <input type="email" name="email" placeholder="E-mail"/>
            <br>
            <button type="submit" name="submit">Submit</button>
            <button formaction="login.php">Login</button>
          </form>
        </div>
      </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
  </body>
</html>
