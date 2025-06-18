<?php
session_start();

require_once('./conn.php');

$where = '%' . $_POST['where'] . '%';

$stmt = $conn->prepare(query: "SELECT * FROM trips t join accommodations a on t.accommodation_id = a.accommodation_id left join flights f on t.flight_id = f.flight_id WHERE a.location LIKE :where;");
$stmt->bindParam(':where', $where);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['search_results'] = $results;
header("Location: ../searched-trips.php");
exit;
