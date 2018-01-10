<?php
session_start();

  // define variables and set to empty values
  $surname = $name = $gender = $preference = $bio = $age = $interests = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $surname = test_input($_POST["surname"]);
    $bio = test_input($_POST["bio"]);
    $age = test_input($_POST["age"]);
    $gender = test_input($_POST["gender"]);
    $preference = test_input($_POST["preference"]);
    $interests = test_input($_POST["interests"]);
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
    <textarea placeholder="Describe yourself here..." name="bio" rows="5" cols="
    0" required></textarea>
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
    <br>
    Interests:
    <br>
    <table>
      <tr>
        <td><input class="box" type="checkbox" name="interests" value="tattoos">Tattoos</td>
        <td><input class="box" type="checkbox" name="interests" value="piercings">Piercings</td>
        <td><input class="box" type="checkbox" name="interests" value="music">Music</td>
      </tr>
      <tr>
        <td><input class="box" type="checkbox" name="interests" value="art">Art</td>
        <td><input class="box" type="checkbox" name="interests" value="music">Music</td>
        <td><input class="box" type="checkbox" name="interests" value="movies">Movies</td>
      </tr>
      <tr>
        <td><input class="box" type="checkbox" name="interests" value="tattoos">Tattoos</td>
        <td><input class="box" type="checkbox" name="interests" value="piercings">Piercings</td>
        <td><input class="box" type="checkbox" name="interests" value="music">Music</td>
      </tr>
      <tr>
        <td><input class="box" type="checkbox" name="interests" value="female">Tattoos</td>
        <td><input class="box" type="checkbox" name="interests" value="female">Piercings</td>
        <td><input class="box" type="checkbox" name="interests" value="male">Music</td>
      </tr>
    </table>
    <br><br>
    <input type="submit" name="submit" value="Submit">
  </form>
