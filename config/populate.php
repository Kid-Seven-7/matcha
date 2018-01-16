 <?php
 require_once ('database.php');

try {
  $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO users (user_name, first_name, surname, bio, age, gender, preference, email, passwd, active, con_code, noti)
   VALUES ('Joe', 'A', 'A', 'just an a', '36', 'female', 'male', 'someone@home.com', '', '1', '', '')";
   // use exec() because no results are returned
   $conn->exec($sql);
   echo "New record created successfully";
   }
catch(PDOException $e)
   {
   echo $sql . "<br>" . $e->getMessage();
   }

$conn = null;
?>
