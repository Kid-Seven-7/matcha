<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Profile pictures</title>
  </head>
  <body>
    <?php include_once 'includes/header.php' ?>
    <div class="profilePicGallery">
      <?php
        session_start();

        try {
            $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM pictures WHERE user = '{$_SESSION['username']}'");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach($stmt->fetchAll() as $k=>$v) {
              // var_dump($v);
              echo "<a href='#'><img class='picResults' src='uploads/{$v['name']}' width='200px' height='200px'";
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
      ?>
    </div>
  </body>
  <?php include_once 'includes/footer.php' ?>
</html>
