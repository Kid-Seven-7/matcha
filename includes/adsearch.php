<?php
session_start();


if ($_POST['gender']){
  echo "gender is {$_POST['gender']}<br>";
  $_SESSION['preference'] = $_POST['gender'];
  echo "pref is {$_SESSION['preference']}<br>";
}

if ($_POST['interests0']){
  echo "likes tats";
}


// if(isset($_GET['gender'])){
// }
// if(isset($_GET[''])){
// }
// if(isset($_GET[''])){
// }
// if(isset($_GET[''])){
// }
// if(isset($_GET[''])){
// }
// if(isset($_GET[''])){
// }
// if(isset($_GET[''])){
// }
// if(isset($_GET[''])){
// }
// if(isset($_GET[''])){
// }
// if(isset($_GET[''])){
// }

header("location: ../cam.php");

?>
