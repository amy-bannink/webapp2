<?php
require_once 'conn.php'; 

$destination = $_POST['where'];
$checkin = $_POST['check-in'];
$checkout = $_POST['check-out'];
$guests = (int) $_POST['who'];
$flight = isset($_POST['flight']) ? 1 : 0;

try {
    $sql = "INSERT INTO boekingen (bestemming, checkin, checkout, gasten, vlucht) 
            VALUES (:destination, :checkin, :checkout, :guests, :flight)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':destination', $destination);
    $stmt->bindParam(':checkin', $checkin);
    $stmt->bindParam(':checkout', $checkout);
    $stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
    $stmt->bindParam(':flight', $flight, PDO::PARAM_INT);

    $stmt->execute();

    echo "Zoekopdracht succesvol opgeslagen.";
} catch (PDOException $e) {
    echo "Fout bij opslaan: " . $e->getMessage();
}
?>
