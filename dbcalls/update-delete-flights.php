<?php
include('./conn.php');

$action = $_POST['action'] ?? '';
$flightId = $_POST['flight_id'] ?? null;

if ($action === 'update') {
    $stmt = $conn->prepare("UPDATE flights SET airline = ?, departure_airport = ?, arrival_airport = ?, departure_date = ?, arrival_date = ?, price = ? WHERE flight_id = ?");
    $stmt->execute([
        $_POST['airline'],
        $_POST['departure_airport'],
        $_POST['arrival_airport'],
        $_POST['departure_date'],
        $_POST['arrival_date'],
        $_POST['price'],
        $flightId
    ]);
} elseif ($action === 'delete') {
    $unlinkStmt = $conn->prepare("UPDATE trips SET flight_id = NULL WHERE flight_id = ?");
    $unlinkStmt->execute([$flightId]);

    $deleteStmt = $conn->prepare("DELETE FROM flights WHERE flight_id = ?");
    $deleteStmt->execute([$flightId]);
}

header("location: ../admin-crud.php");
exit;