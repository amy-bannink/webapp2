<?php
session_start();

require_once('./conn.php');

$where = '%' . $_POST['where'] . '%';

$stmt = $conn->prepare(query: 
"SELECT * 
FROM trips t 
join accommodations a on t.accommodation_id = a.accommodation_id 
left join flights f on t.flight_id = f.flight_id 
left join locations l on a.location_id = l.location_id
WHERE l.country_name LIKE :where OR l.city_name LIKE :where;");

$stmt->bindParam(':where', $where);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['search_results'] = $results;
header("Location: ../searched-trips.php");
exit;
