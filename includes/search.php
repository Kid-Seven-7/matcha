
    <?php include_once 'includes/header.php' ?>
    <?php
    include_once('database.php');

    echo "<div class='searchTable'>";
    echo "<table style='border: solid 1px black;'>";
     echo "<tr><th>user_name</th><th>firstname</th><th>surname</th><th>bio</th></tr>";

    class TableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
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
        $stmt = $conn->prepare("SELECT user_name, first_name, surname, bio FROM users");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          if ($v == ""){
            echo "empty";
          }else{
            echo $v;
          }
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";
    echo "</div>";
    ?>
