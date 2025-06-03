<?php
include("./dbcalls/conn.php");

$stmt = $conn->prepare(query: "SELECT a.location, a.location_img, a.price_per_night, f.departure_airport, f.arrival_airport, f.price FROM trips t join accommodations a on t.accommodation_id = a.accommodation_id left join flights f on t.flight_id = f.flight_id;");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $conn->prepare("SELECT * FROM trips;");
$stmt->execute();
$result = $stmt->fetchAll();
