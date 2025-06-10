<?php
$servername = "mariadb";
$username = "admin";
$password = "admin";
$dbname = "RouteScoutDB"; 


try {
  $conn = new PDO("mysql:host=$servername;dbname=RouteScoutDB", $username, $password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  $conn = null;
}
?>
