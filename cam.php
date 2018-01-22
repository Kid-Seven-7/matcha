<?php

  session_start();

  if (isset($_GET['no_image'])) {
    echo "<script>alert('Please select a photo to upload first!')</script>";
  }
  else if (isset($_GET['file_error'])) {
    echo "<script>alert('Error: Image is invalid.')</script>";
  }
  else if (isset($_GET['format_not_supported'])) {
    echo "<script>alert('Only jpeg, jpg and png are allowed!')</script>";
  }
  else if (isset($_GET['file_too_large'])) {
    echo "<script>alert('File too large!!!. Try a file less than 10mb')</script>";
  }
  else if (isset($_GET['file_exists'])) {
    echo "<script>alert('File already exists. Try a different photo')</script>";
  }
  else if (isset($_GET['file_uploaded'])) {
    echo "<script>alert('File uploaded!')</script>";
  }
  else if (isset($_GET['file_not_found'])) {
    echo "<script>alert('Error: File not found!')</script>";
  }
  else if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_GET['login']) && $_GET['login'] == 1) {
    echo ("<script>alert('Logged in successfully');</script>");
  }
  // Allows non-users to view profiles

  // else if ($_SESSION['username'] == "" || $_SESSION['email'] == "") {
  //   header("Location: login.php?user=res");
  //   exit();
  // }

?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Matcha</title>
  </head>
  <body>
    <?php include_once 'includes/header.php' ?>
    <main>
      <div class="MainPageContainer">
        <div class="SideBar">
          <h3>What are you looking for?</h3>
          <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="">Gender:</label><br>
            <input type="radio" name="gender" value="male"> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>
            <input type="radio" name="gender" value="both" checked> Both
            <br><br>
            <label for="">Interests:</label>
            <div class="tableDiv">
              <!-- Because tables look neater -->
              <table>
                <tr>
                  <td><input class="box" type="checkbox" name="interests0" value="Tattoos">Tattoos</td>
                  <td><input class="box" type="checkbox" name="interests1" value="Piercings">Piercings</td>
                  <td><input class="box" type="checkbox" name="interests2" value="Music">Music</td>
                </tr>
                <tr>
                  <td><input class="box" type="checkbox" name="interests3" value="Art">Art</td>
                  <td><input class="box" type="checkbox" name="interests4" value="Gaming">Gaming</td>
                  <td><input class="box" type="checkbox" name="interests5" value="Cooking">Cooking</td>
                </tr>
                <tr>
                  <td><input class="box" type="checkbox" name="interests6" value="Anime">Anime</td>
                  <td><input class="box" type="checkbox" name="interests7" value="Cycling">Cycling</td>
                  <td><input class="box" type="checkbox" name="interests8" value="Sports">Sports</td>
                </tr>
                <tr>
                  <td><input class="box" type="checkbox" name="interests9" value="Fitness">Fitness</td>
                  <td><input class="box" type="checkbox" name="interests10" value="Pets">Pets</td>
                  <td><input class="box" type="checkbox" name="interests11" value="Nature">Nature</td>
                </tr>
              </table>
            </div>
            <br>
            <script>
            var slider = document.getElementById("myRange");
            var output = document.getElementById("demo");
            output.innerHTML = slider.value;

            slider.oninput = function() {
              output.innerHTML = this.value;
            }
            </script>
            <div class="buttonDiv">
              <input type="submit" name="submit" value="submit" id="submitButton">
            </div>
          </form>
          </div>
        <div class="MainSection">
          <h2>Your search results</h2>
          <?php
          include_once('database.php');

          echo "<div class='searchTable'>";
          echo "<table style='border: solid 1px black;'>";
          echo "<tr><th>user_name</th><th>firstname</th><th>surname</th><th>bio</th></tr>";

          class TableRows extends RecursiveIteratorIterator {
              function __construct($it) {
                  parent::__construct($it, self::LEAVES_ONLY);
              }

              function current() {
                  return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
              }

              function beginChildren() {
                  echo "<tr>";
              }

              function endChildren() {
                  echo "</tr>" . "\n";
              }
          }

          try {
              $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              //Because "both" is not a Gender
              if($_POST['gender'] == 'both'){
                $stmt = $conn->prepare("SELECT user_name, first_name, surname, bio FROM users");
              }else{
                $stmt = $conn->prepare("SELECT user_name, first_name, surname, bio FROM users WHERE gender = '{$_POST['gender']}'");
              }
              $stmt->execute();

              // set the resulting array to associative
              $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

              foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                echo $v;
              }
          }
          catch(PDOException $e) {
              echo "Error: " . $e->getMessage();
          }
          $conn = null;
          echo "</table>";
          echo "</div>";
          ?>
        </div>
      </div>
      <section>
        <?php include_once 'includes/footer.php' ?>
      </section>
    </main>
  </body>
</html>
