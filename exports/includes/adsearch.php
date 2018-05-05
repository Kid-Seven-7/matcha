<?php
session_start();
include ("config/database.php");

if (isset($_POST['gender'])){
  $_SESSION['preference'] = $_POST['gender'];
}if (isset($_POST['age'])){
  $_SESSION['age_range'] = $_POST['age'];
}if (isset($_POST['fame'])){
  $_SESSION['fame_range'] = $_POST['fame'];
}

$array = [];
if (isset($_POST['interests0'])){
  $array[] = $_POST['interests0'];
}if (isset($_POST['interests1'])){
  $array[] = $_POST['interests1'];
}if (isset($_POST['interests2'])){
  $array[] = $_POST['interests2'];
}if (isset($_POST['interests3'])){
  $array[] = $_POST['interests3'];
}if (isset($_POST['interests4'])){
  $array[] = $_POST['interests4'];
}if (isset($_POST['interests5'])){
  $array[] = $_POST['interests5'];
}if (isset($_POST['interests6'])){
  $array[] = $_POST['interests6'];
}if (isset($_POST['interests7'])){
  $array[] = $_POST['interests7'];
}if (isset($_POST['interests8'])){
  $array[] = $_POST['interests8'];
}if (isset($_POST['interests9'])){
  $array[] = $_POST['interests9'];
}if (isset($_POST['interests10'])){
  $array[] = $_POST['interests10'];
}if (isset($_POST['interests11'])){
  $array[] = $_POST['interests11'];
}

$_SESSION['interests'] = $array;

header("location: ../cam.php");

?>
