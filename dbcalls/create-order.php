<?php
include("./conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    $trip_id = $_POST['trip_id'];
    $guests = $_POST['guests'];
    $nights = $_POST['nights'];

    $order_date = date('Y-m-d');
    $status = 'booked';

    $stmt = $conn->prepare('SELECT a.price_per_night FROM trips t inner join accommodations a on t.accommodation_id = a.accommodation_id WHERE t.trip_id = :trip_id');
    $stmt->bindParam(':trip_id', $trip_id);
    $stmt->execute();
    $price_per_night = $stmt->fetch();

    // var_dump($price_per_night['price_per_night']);
    

  
    $price_total = $price_per_night['price_per_night'] * $nights;
    

// var_dump($price_total);

    try {
        $stmt = $conn->prepare("INSERT INTO orders (user_id, trip_id, order_date, guests, price_total, status) 
                        VALUES (:user_id, :trip_id, :order_date, :guests, :price_total, :status)");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':trip_id', $trip_id);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':guests', $guests);
        $stmt->bindParam(':price_total', $price_total);
        $stmt->bindParam(':status', $status);

        $stmt->execute();

        header("Location: ../profile.php");

    } catch (PDOException $e) {
        echo "Error adding flight: " . $e->getMessage();
    }
}
?>