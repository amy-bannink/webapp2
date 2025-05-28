<?php

include("conn.php");

$trip_name = $_POST['trip_name'];
$destination = $_POST['destination'];
$description = $_POST['description'];
$price = $_POST['price'];
$flight_id = $_POST['flight_id'];

var_dump($_POST);

$sql = 'UPDATE trips SET Trip_name = :trip_name, Destination = :destionation, Discription = :discription, Price = :price, Flight_id = :flight_id WHERE ID = :trip_id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(":trip_id", $trip_id );
$stmt->bindParam(":trip_name", $trip_name );
$stmt->bindParam(":destination", $destination );
$stmt->bindParam(":description", $description );
$stmt->bindParam(":price", $price );
$stmt->bindParam(":flight_id", $flight_id );
$stmt->execute();


header("location: ../admin.php");  