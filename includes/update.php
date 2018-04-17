<?php

//check if new username is valid
if (isset($_GET['signup']) && $_GET['signup'] == "invalid") {
  echo "<script>alert('Username can only contain characters a-z')</script>";
}

include ("config/database.php");
  // define variables and set to empty values
  $mail = $username = $surname = $name = $gender = $preference = $bio = $age = $interests = "";

  //assign values to the variables
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["username"])){
      $username = test_input($_POST["username"]);
      if (!preg_match("/^[a-zA-Z]*$/", $username)) {
        echo "<script>alert('Username can only contain characters a-z')</script>";
      }else{
        $_SESSION['username'] = $username;
      }
    }else{
      $username = $_SESSION['username'];
    }
    $mail = test_input($_POST['new_email']);
    $name = test_input($_POST["name"]);
    $surname = test_input($_POST["surname"]);
    $bio = test_input($_POST["bio"]);
    $age = test_input($_POST["age"]);
    $gender = test_input($_POST["gender"]);
    $preference = test_input($_POST["preference"]);
    $_SESSION['preference'] = $preference;

    for($i =0; $i < 12; $i++){
      $interests[] = test_input($_POST["interests".$i]);
    }
  }

  try{
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //updating database values if needed
    if($username){
      $sql = "UPDATE users
      SET user_name='$username'
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if($mail){
      $sql = "UPDATE users
      SET email='$mail'
      WHERE user_name='$username'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if($name){
      $sql = "UPDATE users
      SET first_name='$name'
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if($surname){
      $sql = "UPDATE users
      SET surname='$surname'
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if($bio){
      $sql = "UPDATE users
      SET bio='$bio'
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if($age){
      $sql = "UPDATE users
      SET age='$age'
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if($gender){
      $sql = "UPDATE users
      SET gender='$gender'
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      if($gender == 'female'){
        $sql = "UPDATE users
        SET profilePic='../uploads/female.png'
        WHERE email='$email'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
      }else{
        $sql = "UPDATE users
        SET profilePic='../uploads/male.png'
        WHERE email='$email'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
      }
    }
    if($preference){
      $sql = "UPDATE users
      SET preference='$preference'
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[0]) && $interests[0] != null){
      $sql = "UPDATE users
      SET Tattoos=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[1]) && $interests[1] != null){
      $sql = "UPDATE users
      SET Piercings=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[2]) && $interests[2] != null){
      $sql = "UPDATE users
      SET Music=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[3]) && $interests[3] != null){
      $sql = "UPDATE users
      SET Art=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[4]) && $interests[4] != null){
      $sql = "UPDATE users
      SET Gaming=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[5]) && $interests[5] != null){
      $sql = "UPDATE users
      SET Cooking=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[6]) && $interests[6] != null){
      $sql = "UPDATE users
      SET Anime=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[7]) && $interests[7] != null){
      $sql = "UPDATE users
      SET Cycling=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[8]) && $interests[8] != null){
      $sql = "UPDATE users
      SET Sports=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[9]) && $interests[9] != null){
      $sql = "UPDATE users
      SET Fitness=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[10]) && $interests[10] != null){
      $sql = "UPDATE users
      SET Pets=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    if(isset($interests[11]) && $interests[11] != null){
      $sql = "UPDATE users
      SET Nature=1
      WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
  }
  catch(PDOException $e) {
    echo "error: ".$e;
  }

  //the same as escaping string (no sql injections here)
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
<h2>Update Profile</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Userame:
  <br>
  <input size="30" type="text" name="username" placeholder="username" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>">
  <br><br>
  Email:
  <br>
  <input size="30" type="email" name="new_email" placeholder="email" value="<?php if(isset($_POST['new_email'])) echo htmlentities($_POST['new_email']); ?>">
  <br><br>
  Name:
  <br>
  <input size="30" type="text" name="name" placeholder="name" value="<?php if(isset($_POST['name'])) echo htmlentities($_POST['name']); ?>">
  <br><br>
  Surname:
  <br>
  <input size="30" type="text" name="surname" placeholder="surname" value="<?php if(isset($_POST['surname'])) echo htmlentities($_POST['surname']); ?>">
  <br><br>
  Bio:
  <br>
  <textarea placeholder="Describe yourself here..." name="bio" rows="5" cols="27"></textarea>
  <br><br>
  Age:
  <br>
  <input type="number" name="age" placeholder="25" min="18" max="45" value="<?php if(isset($_POST['age'])) echo htmlentities($_POST['age']); ?>">
  <br><br>
  Gender:
  <br>
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <br><br>
  Sexual Preference:
  <br>
  <input type="radio" name="preference" value="female">Female
  <input type="radio" name="preference" value="male">Male
  <input type="radio" name="preference" value="both">Both
  <br><br>
  <?php
    try {
      $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT *
              FROM users
              WHERE email='$email'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (count($result)) {
        foreach($result as $row) {
          //check and disable interests
          echo "Interests: <br><table>";
          echo "<tr>";
          if(($row['Tattoos'])){
            echo "<td><input class='box' type='checkbox' name='interests0' value='Tattoos' checked disabled>Tattoos</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests0' value='Tattoos'>Tattoos</td>";
          }
          if(($row['Piercings'])){
            echo "<td><input class='box' type='checkbox' name='interests1' value='Piercings' checked disabled>Piercings</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests1' value='Piercings'>Piercings</td>";
          }
          if(($row['Music'])){
            echo "<td><input class='box' type='checkbox' name='interests2' value='Music' checked disabled>Music</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests2' value='Music'>Music</td>";
          }
          echo "</tr>";
          echo "<tr>";
          if(($row['Art'])){
            echo "<td><input class='box' type='checkbox' name='interests3' value='Art' checked disabled>Art</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests3' value='Art'>Art</td>";
          }
          if(($row['Gaming'])){
            echo "<td><input class='box' type='checkbox' name='interests4' value='Gaming' checked disabled>Gaming</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests4' value='Gaming'>Gaming</td>";
          }
          if(($row['Cooking'])){
            echo "<td><input class='box' type='checkbox' name='interests5' value='Cooking' checked disabled>Cooking</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests5' value='Cooking'>Cooking</td>";
          }
          echo "</tr>";
          echo "<tr>";
          if(($row['Anime'])){
            echo "<td><input class='box' type='checkbox' name='interests6' value='Anime' checked disabled>Anime</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests6' value='Anime'>Anime</td>";
          }
          if(($row['Cycling'])){
            echo "<td><input class='box' type='checkbox' name='interests7' value='Cycling' checked disabled>Cycling</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests7' value='Cycling'>Cycling</td>";
          }
          if(($row['Sports'])){
            echo "<td><input class='box' type='checkbox' name='interests8' value='Sports' checked disabled>Sports</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests8' value='Sports'>Sports</td>";
          }
          echo "</tr>";
          echo "<tr>";
          if(($row['Fitness'])){
            echo "<td><input class='box' type='checkbox' name='interests9' value='Fitness' checked disabled>Fitness</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests9' value='Fitness'>Fitness</td>";
          }
          if(($row['Pets'])){
            echo "<td><input class='box' type='checkbox' name='interests10' value='Pets' checked disabled>Pets</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests10' value='Pets'>Pets</td>";
          }
          if(($row['Nature'])){
            echo "<td><input class='box' type='checkbox' name='interests11' value='Nature' checked disabled>Nature</td>";
          }else{
            echo "<td><input class='box' type='checkbox' name='interests11' value='Nature'>Nature</td>";
          }
          echo "</tr></table>";
        }
      }
    }catch(PDOException $e) {
      echo "error: ".$e;
    }
  ?>
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>
<br>
  <!-- location -->
  <a href='geocode.php'>set location manually</a> or
  <a href='location.php'>set location automatically</a>"
<br><br>
<!-- not working yet -->
<!-- <a href="delete.php">Delete account</a> -->
