<header>
  <div class="TitleBar">
    <h1>Matcha</h1>
  </div>
  <div class="NavBar">
    <a href="index.php">Home</a>
    <?php
      if (!isset($_SESSION['username']))
      {
        echo ("<a href='login.php'>Login </a>");
        echo ("<a href='#'>Preview Site </a>");
      }
      if (isset($_SESSION['username']))
      {
        echo ("<a href='profile.php'>Profile </a>");
        echo ("<a href='#'>Logout </a>");
      }
    ?>
  </div>
</header>
