<header>
  <div class="TitleBar">
    <h1>Matcha</h1>
  </div>
  <div class="NavBar">

    <?php
      if (!isset($_SESSION['username']))
      {
        echo ("<a href='index.php'>Home </a>");
        echo ("<a href='login.php'>Login </a>");
        echo ("<a href='#'>Preview Site </a>");
      }
      if (isset($_SESSION['username']))
      {
        echo ("<a href='cam.php'>Home </a>");
        echo ("<a href='profile.php'>Profile </a>");
        echo ("<a href='config/logout.php'>Logout </a>");
      }
    ?>
  </div>
</header>
