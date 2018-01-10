<header>
  <div class="TitleBar">
    <h1>Matcha</h1>
  </div>
  <div class="NavBar">
    <?php
      /* Not logged in */
      if (!isset($_SESSION['username']))
      {
        echo ("<a href='index.php'>Home </a>");
        echo ("<a href='login.php'>Login </a>");
        echo ("<a href='#'>Preview Site </a>");
      }
      /* logged in */
      if (isset($_SESSION['username']))
      {
        echo ("<a href='profile.php'>Profile </a>");
        echo ("<a href='cam.php'>Search </a>");
        echo ("<a href='config/logout.php'>Logout </a>");
      }
    ?>
  </div>
</header>
