<?php

include("conn.php");

$accommodation_id = $_POST['accommodation_id'];
$name = $_POST['name'];
$location_id = $_POST['location_id'];
$image = $_POST['image'];
$accommodation_description = $_POST['accommodation_description'];
$price_per_night = $_POST['price_per_night'];
$max_guests = $_POST['max_guests'];


$sql='
UPDATE accommodations 
SET 
name = :name, 
location_id = :location_id, 
image = :image, 
accommodation_description = :accommodation_description, 
price_per_night = :price_per_night, 
max_guests = :max_guests 
WHERE accommodation_id = :accommodation_id';

$stmt = $conn->prepare($sql);
$stmt->bindParam(":accommodation_id", $accommodation_id);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":location_id", $location_id);
$stmt->bindParam(":image", $image);
$stmt->bindParam(":accommodation_description", $accommodation_description);
$stmt->bindParam(":price_per_night", $price_per_night);
$stmt->bindParam(":max_guests", $max_guests);
$stmt->execute();
header("location: ../admin-crud.php");