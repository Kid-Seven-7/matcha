<?php
include_once 'config/database.php';
if (isset($_GET['view'])){
	$user = $_GET['view'];
	try{
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("SELECT *
														FROM users
														WHERE user_name = '$user'");
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$id = $row['id'];
		}

		header("Location: checkout.php?user={$id}");

	}catch (PDOException $e){
		echo "Unable to : $e";
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Your connections</title>
  </head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <body>
    <?php include_once 'includes/header.php' ?>
    <div class="chatContainer">
      <div class="chatNotifications">
        <h2>Notifications</h2>
        <br>
        <?php include_once 'includes/history.php' ?>
        <?php include_once 'includes/likes.php' ?>
        <?php include_once 'includes/connections.php' ?>
        <?php include_once 'includes/message.php' ?>
      </div>

      <div class="chatMainSection" id="MainChat">
        <?php include_once 'includes/im.php' ?>
      </div>
    </div>
		<script>
		$('#reply').click(function() {
			location.reload();
		});
		</script>
  </body>
</html>
