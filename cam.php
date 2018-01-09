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
  else if ($_SESSION['username'] == "" || $_SESSION['email'] == "") {
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
          I'm looking for:
          <br>
          <br>
          <label for="">Gender</label>
          <select>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Both">Both</option>
          </select>
          <p>Age: ±<span id="demo"></span></p>
          <input type="range" min="18" max="100" value="29" class="slider" id="myRange">
          <script>
            var slider = document.getElementById("myRange");
            var output = document.getElementById("demo");
            output.innerHTML = slider.value;

            slider.oninput = function() {
              output.innerHTML = this.value;
            }
          </script>
          </div>
        <div class="MainSection">

        </div>
      </div>
      <section>
        <form method="POST" accept-charset="utf-8" name="form1">
          <input name="hidden_data" type="hidden"/>
          </form>
          <form method="POST" accept-charset="utf-8" name="save_canvas">
          <input name="hidden_data_2" type="hidden"/>
        </form>
        <?php include_once 'includes/footer.php' ?>
      </section>
    </main>
  </body>
</html>
