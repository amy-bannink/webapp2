<?php
include("./dbcalls/conn.php");

$stmt = $conn->prepare(query: "SELECT l.*, t.*, a.name, a.country_id, a.price_per_night, f.departure_airport, f.arrival_airport, f.price FROM trips t join accommodations a on t.accommodation_id = a.accommodation_id join locations l on a.country_id = l.country_id left join flights f on t.flight_id = f.flight_id;");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);