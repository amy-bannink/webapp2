<?php
include 'conn.php';

$stmt = $conn->prepare( 
    "SELECT * FROM orders o
    inner join trips t 
    on t.trip_id = o.trip_id
    inner join accommodations a
    on t.accommodation_id = a.accommodation_id
    inner join locations l
    on a.location_id = l.location_id
    left join flights f
    on t.flight_id = f.flight_id
    WHERE o.user_id = :user_id 
    ORDER BY o.order_date ASC");

$stmt->bindParam(':user_id', $_SESSION['user_id']);

$stmt->execute();

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
