<?php
include_once '../config/database.php';

function update($field, $value, $email) {
  try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE users
            SET $field='$value'
            WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
  }catch(PDOException $e) {
    echo "error: ".$e;
  }
}
?>

if (this){
  update(surname, $surname, $email)
}

// try {
//   $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//   $sql = "UPDATE users
//           SET first_name='$name',
//           surname='$surname',
//           bio='$bio',
//           age='$age',
//           gender='$gender',
//           preference='$preference'
//           WHERE email='$email'";
//   $_SESSION['first_name'] = $name;
//   $_SESSION['surname'] = $surname;
//   $_SESSION['bio'] = $bio;
//   $_SESSION['age'] = $age;
//   $_SESSION['gender'] = $gender;
//   $_SESSION['preference'] = $preference;
//   $stmt = $conn->prepare($sql);
//   $stmt->execute();
//   // $stmt->execute(array(':first_name' => $name,':email' => $email));
//   $conn = null;
// }
// catch(PDOException $e) {
//   echo "error: ".$e;
// }
