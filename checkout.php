<?php
session_start();
require_once('config/database.php');
if(isset($_GET['user'])){
  $user_id = $_GET['user'];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Just looking :)</title>
  </head>

  <body>
    <?php include_once 'includes/header.php' ?>
    <div class="checkingOut">
      <?php

      //view history
      function history(){
        $username = $_SESSION['username'];
        try{
          $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha',
                          'root',
                          'joseph07');
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("INSERT INTO history (viewer, view, seen)
                                  VALUES(:viewer, :view, :seen)");

          $stmt->execute(array(':viewer' => $username, ':view' => $_SESSION['checkingout'], ':seen' => 0));
        }catch(PDOException $e) {

        }
      }

      try {
        //search result profile
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT *
                FROM users
                WHERE id='$user_id'";
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)) {
          foreach($result as $row) {
            echo "<h2>{$row['user_name']}'s Profile</h2><br>";
            $_SESSION['checkingout'] = $row['user_name'];
            echo "<div class='leftDiv'>";
            echo "<img src='uploads/{$row['profilePic']}' class='searchpic'><br>";
            echo "</div><div class='rightDiv'>";
            if(empty($row['fame'])){
              echo "<strong>Fame rating:</strong> Not set<br>";
            }else{
              echo "<strong>Fame rating:</strong> {$row['fame']}<br>";
            }
            if(empty($row['first_name'])){
              echo "<strong>Firstname:</strong> Not set<br>";
            }else{
              echo "<strong>Firstname:</strong> {$row['first_name']}<br>";
            }
            if(empty($row['surname'])){
              echo "<strong>Surname:</strong> Not set<br>";
            }else{
              echo "<strong>Surname:</strong> {$row['surname']}<br>";
            }
            if(empty($row['bio'])){
              echo "<strong>Bio:</strong> Not set<br>";
            }else{
              echo "<strong>Bio:</strong> {$row['bio']}<br>";
            }
            if(empty($row['age'])){
              echo "<strong>Age:</strong> Not set<br>";
            }else{
              echo "<strong>Age:</strong> {$row['age']}<br>";
            }
            if(empty($row['gender'])){
              echo "<strong>Gender:</strong> Not set<br>";
            }else{
              echo "<strong>Gender:</strong> {$row['gender']}<br>";
            }
            if(empty($row['preference'])){
              echo "<strong>Preference:</strong> Not set<br>";
            }else{
              echo "<strong>Preference:</strong> {$row['preference']}<br>";
            }
            echo "<strong>Interests:</strong><br>";
            if(($row['Tattoos'])){
              echo "<pre>    #Tattoos</pre>";
            }
            if(($row['Piercings'])){
              echo "<pre>    #Piercings</pre>";
            }
            if(($row['Music'])){
              echo "<pre>    #Music</pre>";
            }
            if(($row['Art'])){
              echo "<pre>    #Art</pre>";
            }
            if(($row['Gaming'])){
              echo "<pre>    #Gaming</pre>";
            }
            if(($row['Cooking'])){
              echo "<pre>    #Cooking</pre>";
            }
            if(($row['Anime'])){
              echo "<pre>    #Anime</pre>";
            }
            if(($row['Cycling'])){
              echo "<pre>    #Cycling</pre>";
            }
            if(($row['Sports'])){
              echo "<pre>    #Sports</pre>";
            }
            if(($row['Fitness'])){
              echo "<pre>    #Fitness</pre>";
            }
            if(($row['Pets'])){
              echo "<pre>    #Pets</pre>";
            }
            if(($row['Nature'])){
              echo "<pre>    #Nature</pre>";
            }
            $seen = explode(" ", $row['lastseen']);

            $seen[1] = substr_replace($seen[1], "", -7);
            if ($seen[0] == date("Y-m-d")){
              echo "last seen @ {$seen[1]}<br>";
            }else{
              echo "last seen on {$seen[0]} @ {$seen[1]}<br>";
            }
          }
        }
      }catch(PDOException $e) {
        echo "error: ".$e;
      }

      history();

      $name = $_SESSION['username'];
      try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $liked = 0;
        $sql = "SELECT *
                FROM likes
                WHERE liker='$name'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key) {
          if($key['likee'] == $_SESSION['checkingout']){
            $liked = 1;
          }
        }
        //To like or to unlike
        if($liked == 0){
          echo "<a href='includes/like.php?liker={$user_id}'><img src='resources/facebook-like.png' alt='like' width='30px' height='30px'>Like</a>";
        }else{
          echo "<a href='includes/unlike.php'><img src='resources/thumb.png' alt='like' width='30px' height='30px'>Unike</a>";
        }
        echo "<br><br><a href=#> report as fake <a>";
        echo "<br><br><a href=#>block<a>";
      }catch(PDOException $e) {
        echo "error: ".$e;
      }
      ?>
    </div>
  </body>
</html>
