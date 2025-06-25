<?php
session_start();

if (!isset($_GET['id'])) {
    die('Geen trip ID opgegeven.');
}

$trip_id = $_GET['id'];
include('./dbcalls/read-trip.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Trip</title>
</head>

<body>

    <header class="locations">
        <?php
        include('./includes/header.php');
        ?>
    </header>

    <main class="trip-main">
        <?php
        echo '<div class="trip-title">' .
            '<h1> ' . $result['trip_name'] . '</h1>' .
            '<p>' . $result['trip_description'] . '</p>' .
            '</div>' .
            '<section class="acc">' .
            '<h2>Accommodation Details</h2>'.
            '<h3>' . $result['name'] . '</h3> <br>' .
            '<p><strong>Description: </strong>' . $result['accommodation_description'] . '</p>' .
            '<p><strong>Max guests: </strong>' . $result['max_guests'] . '</p>' .
            '<p><strong>Price per night: </strong>' . $result['price_per_night'] . '</p>' .
            '</section>' .
            '<section class="fli">' .
            '<h2>Flight Details</h2>' .
            '<h3>' . $result['airline'] . '</h3> <br>' .
            '<p><strong>Departure airport: </strong>' . $result['departure_airport'] . '</p>' .
            '<p><strong>Arrival airport: </strong>' . $result['arrival_airport'] . '</p>' .
            '<p><strong>Departure date: </strong>' . $result['departure_date'] . '</p>' .
            '<p><strong>Arrival date: </strong>' . $result['arrival_date'] . '</p>' .
            '<p><strong>Flight price: </strong>' . $result['price'] . '</p>' .
            '</section>' .
            '<section class="loc">' .
            '<h2>Location Details</h2>' .
            '<h3>' . $result['city_name'] . ', ' . $result['country_name'] . '</h3> <br>' .
            '<p><strong>Region: </strong>' . $result['region'] . '</p>' .
            '<p><strong>Description: </strong>' . $result['description'] . '</p>' .
            '<p><strong>Highlights: </strong>' . $result['highlights'] . '</p>' .
            '<p><strong>Climate: </strong>' . $result['climate'] . '</p>' .
            '</section>' .
            '<section class="loc">' .

            '<img src="' . $result['location_img'] . '" class="trip-img"</img>' .
            '</section>'
        ;
        ?>
        <?php if (isset($_SESSION['user_id'])): ?>
            <section class="btn">

                <form action="./dbcalls/create-order.php" method="POST">
                    <input type="number" name="guests" required min="1" max="<?php $result['max_guests'] ?>" placeholder="Guests">
                    <input type="number" name="nights" required placeholder="Nights">
                    <input type="hidden" name="trip_id" value="<?php echo $trip_id; ?>">
                    <button type="submit" class="trip-button">Book this trip</button>
                </form>
        </section>

        <?php else: ?>
            <p> <a href="login.php">Log in</a> to book this trip.</p>
        <?php endif; ?>

    </main>


    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>
</body>

</html>