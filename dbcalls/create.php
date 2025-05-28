<h1>create</h1>
<?php
include("./conn.php");


$trip_name = $_POST['trip_name'];
$destination = $_POST['destination'];
$description = $_POST['description'];
$price = $_POST['price'];
$flight_id = $_POST['flight_id'];

$sql = 'INSERT INTO trips(Trip_name, Destination, Description, price, flight_id) VALUES (:trip_name, :destination, :description, :price, :flight_id);';

$stmt = $conn->prepare($sql);
$stmt->bindParam(":trip_name", $trip_name);
$stmt->bindParam(":destination", $destination);
$stmt->bindParam(":description", $description);
$stmt->bindParam(":price", $price);
$stmt->bindParam(":flight_id", $flight_id);
$stmt->execute();

header('Location: ../admin.php');