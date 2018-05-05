<header>
  <div class="TitleBar">
    <?php
    // session_start();
    require_once('config/database.php');

      //Not logged in
      if (!isset($_SESSION['username'])) {
        echo "<h1>Matcha</h1>";
      }

      //Logged in
      if (isset($_SESSION['username'])) {
        try {
          $stmt = $conn->prepare("SELECT *
                                  FROM chats
                                  WHERE sent_to = :user
                                  AND opened = 0");
          $stmt->execute(array(':user' => $_SESSION['username']));
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $msg = count($result);
          if (count($result) >= 1) {
            echo "<a href='chat.php'><h1>Matcha<span>*{$msgs}</span></h1></a>";
          }
          else{
            echo "<a href='chat.php'><h1>Matcha</h1></a>";
          }
        }catch(PDOException $e) {
          echo "error: ".$e;
        }
      }
    ?>
  </div>
  <div class="NavBar">
    <?php

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
