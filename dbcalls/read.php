<?php
include("./dbcalls/conn.php");

$stmt = $conn->prepare(query: "SELECT l.*, t.*, a.*, f.* FROM trips t join accommodations a on t.accommodation_id = a.accommodation_id join locations l on a.location_id = l.location_id left join flights f on t.flight_id = f.flight_id;");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);