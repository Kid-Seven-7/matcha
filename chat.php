
<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Your connections</title>
  </head>
  <body>
    <?php include_once 'includes/header.php' ?>
    <div class="chatContainer">
      <div class="chatNotifications">
        <h2>Notifications</h2>
        <br>
        <?php include_once 'includes/likes.php' ?>
        <?php include_once 'includes/connections.php' ?>
        <?php include_once 'includes/message.php' ?>
      </div>
      <div class="chatMainSection">
        <?php include_once 'includes/im.php' ?>
      </div>
    </div>
  </body>
</html>
