<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Home</title>
</head>

<body>

    <header class="index">
        <?php

        include('./includes/header.php');
        ?>
    </header>

    <main class="main-home">

        <section class="home-grid">
            <?php
            include('./dbcalls/conn.php');
            include('./dbcalls/read.php');
            foreach ($result as $trip) {
                echo '<a href="trip.php?id=' . $trip['trip_id'] . '"class="grid-link">
        <div class="grid-item">
                <img src="' . $trip['location_img'] . '" alt="' . $trip['city_name'] . '">
                <div class="label">
                    <strong>' . $trip['trip_name'] . '</strong><br>';

                $accommodationPrice = (float) $trip['price_per_night'];
                $flightPrice = !empty($trip['price']) ? (float) $trip['price'] : 0;
                $totalPrice = $accommodationPrice + $flightPrice;
                echo 'Vanaf: €' . number_format($totalPrice, 0, ',', '.') . '<br>';


                if (!empty($trip['departure_airport']) && !empty($trip['arrival_airport'])) {
                    echo '✈️ ' . $trip['departure_airport'] . ' → ' . $trip['arrival_airport'];
                } else {
                    echo '🏡 Accommodatie zonder vlucht';
                }


                echo '</div>
            </div>';
            }
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