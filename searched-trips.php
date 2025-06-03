<?php
session_start();
require_once('./dbcalls/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>searched</title>
</head>
<body>

    <header>
        <?php
            include('./includes/header.php');
            ?>
    </header>
<main class="main-home">
    <section class="home-grid">

<?php 
if (isset($_SESSION['search_results']) && count($_SESSION['search_results']) > 0) {
    foreach ($_SESSION['search_results'] as $trip) {
        echo '<div class="grid-item">
                <img src="'. $trip['location_img'] . '" alt="'. $trip['location'] . '">
                <div class="label">
                    <strong>' . $trip['location'] . '</strong><br>';

        $accommodationPrice = (float) $trip['price_per_night'];
        $flightPrice = !empty($trip['price']) ? (float) $trip['price'] : 0;
        $totalPrice = $accommodationPrice + $flightPrice;

        echo 'Vanaf: €' . number_format($totalPrice, 0, ',', '.') . '<br>';

        if (!empty($trip['departure_airport']) && !empty($trip['arrival_airport'])) {
            echo '✈️ ' . $trip['departure_airport'] . ' → ' . $trip['arrival_airport'];
        } else {
            echo '🏡 Accommodatie zonder vlucht';
        }

        echo    '</div>
            </div>';
    }
} else {
    echo '<p>Geen resultaten gevonden.</p>';
    echo '<h2>Reizen die u misschien leuk vindt:</h2>';
    
    // Haal 4 willekeurige trips op uit DB
    $stmt = $conn->query("SELECT * FROM trips ORDER BY RAND() LIMIT 4");
    $randomTrips = $stmt->fetchAll();

    foreach ($randomTrips as $trip) {
        echo '<div class="grid-item">
                <img src="'. $trip['location_img'] . '" alt="'. $trip['location'] . '">
                <div class="label">
                    <strong>' . $trip['location'] . '</strong><br>';

        $accommodationPrice = (float) $trip['price_per_night'];
        $flightPrice = !empty($trip['price']) ? (float) $trip['price'] : 0;
        $totalPrice = $accommodationPrice + $flightPrice;

        echo 'Vanaf: €' . number_format($totalPrice, 0, ',', '.') . '<br>';

        if (!empty($trip['departure_airport']) && !empty($trip['arrival_airport'])) {
            echo '✈️ ' . $trip['departure_airport'] . ' → ' . $trip['arrival_airport'];
        } else {
            echo '🏡 Accommodatie zonder vlucht';
        }

        echo    '</div>
            </div>';
    }
}

unset($_SESSION['search_results']);
?>
</section>
</main>
    <footer>
        <?php
            include('./includes/footer.php');
            ?>
    </footer>
</body>
</html>