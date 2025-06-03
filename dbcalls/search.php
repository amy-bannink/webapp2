<?php
require_once 'conn.php'; 

$destination = $_POST['where'];
$checkin = $_POST['check-in'];
$checkout = $_POST['check-out'];
$flight = isset($_POST['flight']) ? 1 : 0;


$sql = "SELECT t.*, a.*, f.* FROM trips t join accommodations a on t.accommodation_id = a.accommodation_id right join flights f on t.flight_id = f.flight_id";