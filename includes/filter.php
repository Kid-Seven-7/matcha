    <?php
    session_start();
    include_once('database.php');

    try {
        $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT profilePic, user_name, first_name, surname, email FROM users");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach(($stmt->fetchAll())) as $k=>$v) {
          echo $v;
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    <div class="">
      hello
    </div>
