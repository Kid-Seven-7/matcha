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
				$count = 0;
				foreach($stmt->fetchAll() as $k=>$v) {
					$count++;
					echo "<div class='picResults'>";
					echo "<img src='uploads/{$v['name']}' alt='profilePic'><br>";
					echo "<ul>
					<li><a href='includes/set_delete.php?del={$v['name']}'>delete</a></li>
					<li><a href='includes/set_delete.php?set={$v['name']}'>set as prolifepic</a></li>
					</ul>";
					echo "</div>";
				}
				if($count == 0){
					echo "<div class='nopic'><h2>You have no pictures</h2></div>";
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
