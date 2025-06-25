<?php
include('./conn.php');

$action = $_POST['action'] ?? '';
$tripId = $_POST['trip_id'] ?? null;
$accommodationId = $_POST['accomodation_id'] ?? null;

if ($action === 'update') {
    $stmt = $conn->prepare("UPDATE trips SET trip_name = ?, trip_description = ?, flight_id = ?, accomodation_id = ? WHERE trip_id = ?");
    $stmt->execute([
        $_POST['trip_name'],
        $_POST['trip_description'],
        $_POST['flight_id'],
        $_POST['accomodation_id'],
        $tripId
    ]);
} elseif ($action === 'delete') {

    // Check if this trip_id is used in orders
    $checkOrders = $conn->prepare("SELECT COUNT(*) FROM orders WHERE trip_id = ?");
    $checkOrders->execute([$tripId]);

    if ($checkOrders->fetchColumn() > 0) {
        die("Cannot delete this trip. It is referenced in one or more orders.");
    }

    // Proceed with delete only if not used
    $delete = $conn->prepare("DELETE FROM trips WHERE trip_id = ?");
    $delete->execute([$tripId]);

    $delete = $conn->prepare("DELETE FROM accommodations WHERE accomodation_id = ?");
    $delete->execute([$accommodationId]);
}

header("location: ../admin-crud.php");
exit;
