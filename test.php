<?php

  function update($field, $value, $email) {
  try {
    $conn = new PDO('mysql:dbname=Matcha;host:127.0.0.1', 'root', 'joseph07');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE users
            SET $field='$value'
            WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
  }catch(PDOException $e) {
    echo "error: ".$e;
  }

?>


if (this){
  update(surname, $surname, $email)
}
