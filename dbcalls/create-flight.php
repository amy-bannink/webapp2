<?php

include("./conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $airline = $_POST['airline'];
    $departure_airport = $_POST['departure_airport'];
    $arrival_airport = $_POST['arrival_airport'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $price = $_POST['price'];

    try {
        $stmt = $conn->prepare("INSERT INTO flights (airline, departure_airport, arrival_airport, departure_date, arrival_date, price) 
                                VALUES (:airline, :departure_airport, :arrival_airport, :departure_date, :arrival_date, :price)");

        $stmt->bindParam(':airline', $airline);
        $stmt->bindParam(':departure_airport', $departure_airport);
        $stmt->bindParam(':arrival_airport', $arrival_airport);
        $stmt->bindParam(':departure_date', $departure_date);
        $stmt->bindParam(':arrival_date', $arrival_date);
        $stmt->bindParam(':price', $price);

        $stmt->execute();

        header("Location: ../admin.php");

    } catch (PDOException $e) {
        echo "Error adding flight: " . $e->getMessage();
    }
}
?>
