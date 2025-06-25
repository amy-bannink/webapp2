<?php
include('conn.php');

$acc_stmt = $conn->query("SELECT * FROM accommodations");
$accommodations = $acc_stmt->fetchAll(PDO::FETCH_ASSOC);

$fli_stmt = $conn->query("SELECT * FROM flights");
$flights = $fli_stmt->fetchAll(PDO::FETCH_ASSOC);

$loc_stmt = $conn->query("SELECT location_id, city_name, country_name FROM locations");
$locations = $loc_stmt->fetchAll(PDO::FETCH_ASSOC);
