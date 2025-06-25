<?php

include("./conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form input
    $accommodation_name = $_POST['accomodation_name'];
    $location_id = $_POST['location_id'];
    $trip_description = $_POST['trip_description'];
    $price_per_night = $_POST['price_per_night'];
    $max_guests = $_POST['max_guests'];

    $trip_name = $_POST['trip_name'];
    $trip_description = $_POST['trip_description'];
    $flight_id = $_POST['flights'];

    // Handle image upload
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("Error uploading image.");
    }

    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($fileExt, $allowedExt)) {
        die("Only JPG, JPEG, PNG & GIF files are allowed.");
    }

    $newFileName = uniqid('acc_', true) . '.' . $fileExt;
    $destPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($fileTmpPath, $destPath)) {
        die("Failed to move uploaded file.");
    }

    $imagePath = '../uploads/' . $newFileName;

    try {
        // Insert accommodation
        $stmt = $conn->prepare("
            INSERT INTO accommodations 
            (name, location_id, image, trip_description, price_per_night, max_guests) 
            VALUES 
            (:name, :location_id, :image, :trip_description, :price_per_night, :max_guests)
        ");

        $stmt->bindParam(':name', $accommodation_name);
        $stmt->bindParam(':location_id', $location_id);
        $stmt->bindParam(':image', $imagePath);
        $stmt->bindParam(':trip_description', $trip_description);
        $stmt->bindParam(':price_per_night', $price_per_night);
        $stmt->bindParam(':max_guests', $max_guests, PDO::PARAM_INT);

        $stmt->execute();
        $accommodation_id = $conn->lastInsertId();

        // Insert trip
        $stmt2 = $conn->prepare("
            INSERT INTO trips 
            (trip_name, trip_description, flight_id, accommodation_id) 
            VALUES 
            (:trip_name, :trip_description, :flight_id, :accommodation_id)
        ");

        $stmt2->bindParam(':trip_name', $trip_name);
        $stmt2->bindParam(':trip_description', $trip_description);
        $stmt2->bindParam(':flight_id', $flight_id, PDO::PARAM_INT);
        $stmt2->bindParam(':accommodation_id', $accommodation_id, PDO::PARAM_INT);

        $stmt2->execute();

        header("Location: ../admin.php");
        exit;

    } catch (PDOException $e) {
        echo "Error creating trip: " . $e->getMessage();
    }
}
?>


