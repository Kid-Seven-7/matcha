
    <?php include_once 'includes/header.php' ?>
    <?php
    session_start();
    include_once('database.php');

    echo "<div>";
    echo "<table class='searchTable'>";
     echo "<tr><th>user_name</th><th>firstname</th><th>surname</th><th>age</th><th>bio</th></tr>";

    class TableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='width: 150px; border: 0;'>" . parent::current(). "</td>";
        }

        function beginChildren() {
            echo "<tr>";
        }

        function endChildren() {
            echo "</tr>" . "\n";
        }
    }

    try {
        $conn = new PDO('mysql:host=127.0.0.1;dbname=Matcha', 'root', 'joseph07');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(($_POST['gender'] == 'both') || empty($_POST['gender'])){
          $stmt = $conn->prepare("SELECT user_name, first_name, surname, age, bio
                                  FROM users");
        }else{
          $stmt = $conn->prepare("SELECT user_name, first_name, surname, age, bio
                                  FROM users
                                  WHERE gender = '{$_POST['gender']}'");
        }
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          echo {$v};
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";
    echo "</div>";
    ?>
