<?php
require_once("conn.php");
// Debug test
// echo "ID ontvangen: " . ($_GET['id'] ?? 'geen id');
// exit;



if (isset($_GET['id']) && !empty($_GET['id'])) {
    $locationId = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM locations WHERE location_id = :id");
    $stmt->bindParam(':id', $locationId);
    $stmt->execute();

    $location = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$location) {
        var_dump($stmt->errorInfo());
        exit;
    }


} else {
    // Geen ID meegegeven
    header("Location: locations.php");
    exit;
}
?>