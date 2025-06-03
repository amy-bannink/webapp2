<?php
$servername = "mariadb";
$username = "admin";
$password = "admin";
$dbname = "RouteScoutDB"; 

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
$username = "root";
$password = "root";

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  $conn = null;
}
?>
