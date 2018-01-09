  <?php
  // define variables and set to empty values
  $surname = $name = $gender = $preference = $bio = $age = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $surname = test_input($_POST["surname"]);
    $bio = test_input($_POST["bio"]);
    $age = test_input($_POST["age"]);
    $gender = test_input($_POST["gender"]);
    $preference = test_input($_POST["preference"]);
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
  <h2>Update Profile</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name:
    <br>
    <input type="text" name="name" placeholder="name" required>
    <br><br>
    Surname:
    <br>
    <input type="text" name="surname" placeholder="surname" required>
    <br><br>
    Bio:
    <br>
    <textarea placeholder="Describe yourself here..." name="bio" rows="5" cols="40" required></textarea>
    <br><br>
    Age:
    <br>
    <input type="number" name="age" placeholder="25" min="18" max="45" required>
    <br><br>
    Gender:
    <br>
    <input type="radio" name="gender" value="female">Female
    <input type="radio" name="gender" value="male" checked>Male
    <br><br>
    Sexual Preference:
    <br>
    <input type="radio" name="preference" value="female">Female
    <input type="radio" name="preference" value="female">Male
    <input type="radio" name="preference" value="male" checked>Both
    <br><br>
    <input type="submit" name="submit" value="Submit">
  </form>
