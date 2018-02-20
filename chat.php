<!DOCTYPE html>
<html>
  <head>
    <?php include_once 'includes/meta.php' ?>
    <title>Your connections</title>
  </head>
  <body>
    <?php include_once 'includes/header.php' ?>
    <div class="chatContainer">
      <aside class="chatNotifications">
        <h2>Notifications</h2>
        <br>
        <?php include_once 'includes/likes.php' ?>
        <?php include_once 'includes/connections.php' ?>
        <?php include_once 'includes/message.php' ?>
        <?php include_once 'includes/unlike.php' ?>
        <?php include_once 'includes/blocked.php' ?>
        <?php include_once 'includes/chat.php' ?>
      </aside>
      <section class="chatMainSection">
        <?php include_once 'includes/im.php' ?>
        chatMainSection
      </section>
    </div>
  </body>
</html>
