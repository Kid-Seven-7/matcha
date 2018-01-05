<?php

session_start();
require_once ('config/database.php');

if (isset($_GET['user']) && $_GET['user'] == "log")
{
    if (!isset($_SESSION['username']))
    {
        //sign in please
        echo ("<script>alert('Please login/register first');</script>");
    }
    else
    {
        session_destroy();
        echo ("<script>alert('Logged out successfully');</script>");
    }
}
else if (isset($_GET['verify']) && $_GET['verify'] == 1)
{
    if ($_SESSION['username'] && $_SESSION['email'])
    {
        $name = $_SESSION['username'];
        $email = $_SESSION['email'];

        try
        {
            //TODO
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(array(':email' => $email));

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result))
            {
                foreach($result as $row)
                {
                    //TODO
                    if ($row['active'] == 1)
                    {
                        $_SESSION['username'] = $row['user_name'];
                        $_SESSION['email'] = $row['email'];
                        header("Location: cam.php?login=1");
                        exit();
                    }
                    else
                    {
                        header("Location: login.php?not_active");
                        exit();
                    }
                }
            }
        }
        catch(PDOException $e)
        {
            //TODO
            header("Location: login.php?con=error");
            exit();
        }
    }
    else
    {
        header("Location: login.php?user=invalid");
        exit();
    }
}
else if (isset($_SESSION['username']) && isset($_SESSION['email']))
{
    header("Location: index.php");
    exit();
}
if (isset($_GET['login']) && $_GET['login'] == "invalid")
{
    echo "<script>alert('Invalid username/password entered');</script>";
}
else if (isset($_GET['verify']) && $_GET['verify'] == 0)
{
    echo ("<script>alert('You need to verify your account before you can log in');</script>");
}
else if (isset($_GET['user']) && $_GET['user'] == "not_found")
{
    echo ("<script>alert('Login details did not match any of our records. Check your details carefully');</script>");
}
else if (isset($_GET['code']) && $_GET['code'] == -1)
{
    echo ("<script>alert('Error: Code is nolonger valid');</script>");
}
else if (isset($_GET['user']) && $_GET['user'] == "invalid")
{
    echo ("<script>alert('Error: Username / Password is incorrect');</script>");
}
else if (isset($_GET['not_active']))
{
    echo ("<script>alert('You need to activate your account');</script>");
}
else if (isset($_GET['con']) && $_GET['con'] == "error")
{
  echo ("<script>alert('Connection to the server failed');</script>");
}
else if (isset($_GET['reset']) && $_GET['reset'] == "suc")
{
  echo ("<script>alert('Password updated successfully');</script>");
}
else if (isset($_GET['user']) && $_GET['user'] == "res")
{
  echo ("<script>alert('Please login first');</script>");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Login</title>
  </head>
  <body>
    <div class="MainContainer">
      <?php include_once 'includes/header.php' ?>
      <div class="logIn">
        <h2>Login to your account</h2>
        <form action="config/login.inc.php" method="POST">
          <label for="username">Email/Username</label>
          <br>
          <input name="login" placeholder="Email/Username"/>
          <br>
          <label for="passwd">Password</label>
          <br><input type="password" name="passwd" placeholder="Password"/>
          <br>
          <br>
          <button type="submit" name="submit">Login</button>
          <button formaction="index.php">Register</button>
          <br>
        </form>
        <div class="passwd">
          <a href="forgot.php">Forgot password?</a>
        </div>
      </div>
    </div>
  </body>
  <?php include_once 'includes/footer.php' ?>
</html>
