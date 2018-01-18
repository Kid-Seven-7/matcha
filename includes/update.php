<?php
session_start();
include ("../config/database.php");

  // define variables and set to empty values
  $surname = $name = $gender = $preference = $bio = $age = $interests = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $surname = test_input($_POST["surname"]);
    $bio = test_input($_POST["bio"]);
    $age = test_input($_POST["age"]);
    $gender = test_input($_POST["gender"]);
    $preference = test_input($_POST["preference"]);
    //$interests = test_input($_POST["interests"]);

    $i = 0;
    while ($i < 12)
    {
      $interests[] = test_input($_POST["interests".$i]);
      $i++;
    }
  }

  try {
    $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE users
            SET first_name='$name',
            surname='$surname',
            bio='$bio',
            age='$age',
            gender='$gender',
            preference='$preference'
            WHERE email='$email'";
    $_SESSION['first_name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['bio'] = $bio;
    $_SESSION['age'] = $age;
    $_SESSION['gender'] = $gender;
    $_SESSION['preference'] = $preference;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // $stmt->execute(array(':first_name' => $name,':email' => $email));
    $conn = null;
  }
  catch(PDOException $e) {
    echo "error: ".$e;
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (isset($_GET["upload"]) && ($_GET["upload"] == "successful")){
    echo ("<script>alert('Your upload was successful')</script>");
  }

?>
  <h2>Update Profile</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name:
    <br>
    <input size="30" type="text" name="name" placeholder="name" required>
    <br><br>
    Surname:
    <br>
    <input size="30" type="text" name="surname" placeholder="surname" required>
    <br><br>
    Bio:
    <br>
    <textarea placeholder="Describe yourself here..." name="bio" rows="5" cols="27" required></textarea>
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
    Interests:
    <br>
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
    <br><br>
    <input type="submit" name="submit" value="Submit">

  </form>
