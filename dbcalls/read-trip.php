<?php
require_once('conn.php');
$trip_id = $_GET['trip_id'] ?? null;
$result = null;

if ($trip_id) {
    $stmt = $conn->prepare("

SELECT l.*, t.*, a.*, f.* FROM trips t join accommodations a on t.accommodation_id = a.accommodation_id join locations l on a.location_id = l.location_id left join flights f on t.flight_id = f.flight_id WHERE t.trip_id = :trip_id;


    ");

    $stmt->execute(['trip_id' => $trip_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Slechts 1 resultaat ophalen
}
?>