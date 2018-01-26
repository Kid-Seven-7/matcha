<header>
  <div class="TitleBar">
    <?php
      //Not logged in
      if (!isset($_SESSION['username'])) {
        echo "<h1>Matcha</h1>";
      }

      //Logged in
      if (isset($_SESSION['username'])) {
        echo "<a href='chat.php'><h1>Matcha</h1></a>";
      }
    ?>
  </div>
  <div class="NavBar">
    <?php
    session_start();

      /* Not logged in */
      if (!isset($_SESSION['username'])) {
        echo ("<a href='index.php'>Home</a>");
        echo ("<a href='login.php'>Login</a>");
      }

      /* logged in */
      if (isset($_SESSION['username'])) {
        echo ("<a href='cam.php'>Search</a>");
        if (stripos($_SERVER['REQUEST_URI'], 'cam.php')
          || stripos($_SERVER['REQUEST_URI'], 'profilepic.php')
          || stripos($_SERVER['REQUEST_URI'], 'location.php')
          || stripos($_SERVER['REQUEST_URI'], 'chat.php')
          || stripos($_SERVER['REQUEST_URI'], 'images.php')
          || stripos($_SERVER['REQUEST_URI'], 'checkout.php')
          || stripos($_SERVER['REQUEST_URI'], 'geocode.php')){
          echo ("<a href='profile.php'>Profile</a>");
        }elseif (stripos($_SERVER['REQUEST_URI'], 'profile.php')){
          echo ("<a href='profilepic.php'>Upload profile pic</a>");
        }
        echo ("<a href='config/logout.php'>Logout</a>");
      }
    ?>
  </div>
</header>
