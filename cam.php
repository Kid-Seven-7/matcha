<?php

  session_start();

  if (isset($_GET['no_image'])) {
    echo "<script>alert('Please select a photo to upload first!')</script>";
  }elseif (isset($_GET['file_error'])) {
    echo "<script>alert('Error: Image is invalid.')</script>";
  }elseif (isset($_GET['format_not_supported'])) {
    echo "<script>alert('Only jpeg, jpg and png are allowed!')</script>";
  }elseif (isset($_GET['file_too_large'])) {
    echo "<script>alert('File too large!!!. Try a file less than 10mb')</script>";
  }elseif (isset($_GET['file_exists'])) {
    echo "<script>alert('File already exists. Try a different photo')</script>";
  }elseif (isset($_GET['file_uploaded'])) {
    echo "<script>alert('File uploaded!')</script>";
  }elseif (isset($_GET['file_not_found'])) {
    echo "<script>alert('Error: File not found!')</script>";
  }elseif (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_GET['login']) && $_GET['login'] == 1) {
    echo ("<script>alert('Logged in successfully');</script>");
  }elseif ($_SESSION['username'] == "" || $_SESSION['email'] == "") {
    header("Location: login.php?user=res");
    exit();
  }

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
          <form class="" action="includes/adsearch.php" method="post">
            <label for="">Preference:</label><br>
            <?php
              if(isset($_SESSION['preference'])){
                switch($_SESSION['preference']){
                  case 'male':
                    echo "<input type='radio' name='gender' value='male' checked disabled> Male<br>
                    <input type='radio' name='gender' value='female' disabled> Female<br>
                    <input type='radio' name='gender' value='both' disabled> Both<br>";
                    break;
                  case 'female':
                    echo "<input type='radio' name='gender' value='male' disabled> Male<br>
                    <input type='radio' name='gender' value='female' checked disabled> Female<br>
                    <input type='radio' name='gender' value='both' disabled> Both<br>";
                    break;
                  default:
                    echo "<input type='radio' name='gender' value='male' disabled> Male<br>
                    <input type='radio' name='gender' value='female' disabled> Female<br>
                    <input type='radio' name='gender' value='both' checked disabled> Both<br>";
                    break;
                }
              }else{
                echo "<input type='radio' name='gender' value='male' disabled> Male<br>
                <input type='radio' name='gender' value='female' disabled> Female<br>
                <input type='radio' name='gender' value='both' checked disabled> Both<br>";
              }
            ?>
            <br><br>
            <label for="">Interests:</label>
            <div class="tableDiv">
              <!-- Because tables look neater -->
              <table>
                <?php
                function checkInterestBox(){
                  $array = array("Tattoos", "Piercings",
                                  "Music", "Art",
                                  "Gaming", "Cooking",
                                  "Anime", "Cycling",
                                  "Sports", "Fitness",
                                  "Pets", "Nature");
                  if(isset($_SESSION['interests'])){
                    for ($i=0; $i < 12; $i++) {
                      if($i%2 == 0){
                        echo "<tr>";
                      }
                      if (in_array($array[$i], $_SESSION['interests'])){
                        echo "<td><input class='box' type='checkbox' name='interests{$i}' value='{$array[$i]}' checked>{$array[$i]}</td>";
                      }else {
                        echo "<td><input class='box' type='checkbox' name='interests{$i}' value='{$array[$i]}'>{$array[$i]}</td>";
                      }
                      if($i%2 != 0){
                        echo "</tr>";
                      }
                    }
                  }else{
                    echo "
                    <tr>
                    <td><input class='box' type='checkbox' name='interests0' value='Tattoos'>Tattoos</td>
                    <td><input class='box' type='checkbox' name='interests1' value='Piercings'>Piercings</td>
                    </tr>
                    <tr>
                    <td><input class='box' type='checkbox' name='interests2' value='Music'>Music</td>
                    <td><input class='box' type='checkbox' name='interests3' value='Art'>Art</td>
                    <tr>
                    <td><input class='box' type='checkbox' name='interests4' value='Gaming'>Gaming</td>
                    <td><input class='box' type='checkbox' name='interests5' value='Cooking'>Cooking</td>
                    </tr>
                    <tr>
                    <td><input class='box' type='checkbox' name='interests6' value='Anime'>Anime</td>
                    <td><input class='box' type='checkbox' name='interests7' value='Cycling'>Cycling</td>
                    </tr>
                    <td><input class='box' type='checkbox' name='interests8' value='Sports'>Sports</td>
                    <td><input class='box' type='checkbox' name='interests9' value='Fitness'>Fitness</td>
                    </tr>
                    <tr>
                    <td><input class='box' type='checkbox' name='interests10' value='Pets'>Pets</td>
                    <td><input class='box' type='checkbox' name='interests11' value='Nature'>Nature</td>
                    </tr>
                    ";
                  }
                }
                checkInterestBox();
                ?>
              </table>
            </div>
            <div class="">
              <br><label for="">Maximum Age: <span id="range"></span></label><br>
              <div class="slidecontainer">
                <input type="number" name="age" value="age" id="age_range">
              </div>
            </div>
            <br>
            <div class="buttonDiv">
              <input class="inputButton" type="submit" name="submit" value="submit" id="submitButton">
            </div>
          </form>
          </div>
        <div class="MainSection">
          <h2>Your search results</h2>
          <?php include_once 'includes/search.php' ?>
        </div>
      </div>
      <section>
        <?php include_once 'includes/footer.php' ?>
      </section>
    </main>
  </body>
</html>
