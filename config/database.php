<?php

$DB_DSN = 'mysql:host=127.0.0.1;dbname=Matcha';
$DB_HOST = '127.0.0.1';
$DB_NAME = 'Matcha';
$DB_USER = 'root';
$DB_PASSWORD = '';

$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
