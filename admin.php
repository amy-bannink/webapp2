<?php session_start();

include('./dbcalls/read.php');

$acc_stmt = $conn->query("SELECT accommodation_id, name FROM accommodations");
$accommodations = $acc_stmt->fetchAll(PDO::FETCH_ASSOC);

$fli_stmt = $conn->query("SELECT flight_id, departure_airport, arrival_airport FROM flights");
$flights = $fli_stmt->fetchAll(PDO::FETCH_ASSOC);

$loc_stmt = $conn->query("SELECT country_id, city_name, country_name FROM locations");
$locations = $loc_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>admin</title>
</head>

<body>

    <header class="admin">
        <?php
        include('./includes/small-header.php');
        ?>
    </header>


    <main>
        <div class="create-wrapper">
            <div class="wide-login-box">
                <form action="../dbcalls/create_trip.php" method="post" enctype="multipart/form-data">
                    <div class="create-wrapper">
                        <div class="login">

                            <h2>Create Accomodation</h2>

                            <p>create an accomodation name.</p>
                            <label class="login-items">
                                <input type="text" name="accomodation_name" placeholder="e.g. Beach Resort Barcelona"
                                    required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                            </label><br>

                            <p>choose a location.</p>
                            <label class="login-items">
                                <select name="country_id" required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                                    <option value="">empty</option>
                                    <?php foreach ($locations as $loc): ?>
                                        <option value="<?= $loc['country_id'] ?>">
                                            <?= htmlspecialchars($loc['city_name'] . " in " . $loc['country_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </label><br>

                            <p>upload an image.</p>
                            <div class="img-wrapper login-items">
                                <button class="login-input-inline login-input normal-hover-pointer grey-text">upload
                                    image</button>
                                <input type="file" name="image" accept="image/*" required>
                            </div><br>

                            <p>create a description.</p>
                            <label class="login-items">
                                <input type="text" name="description"
                                    placeholder="e.g. Luxury resort close to the beach." required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                            </label><br>

                            <p>set a price per night.</p>
                            <label class="login-items">
                                <input type="number" name="price_per_night" placeholder="e.g. 110.00" required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                            </label><br>

                            <p>set a maximum amount of guest.</p>
                            <label class="login-items">
                                <input type="number" name="max_guests" placeholder="e.g. 4" required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                            </label><br>

                        </div>
                        <div class="login">

                            <h2>Create Trip</h2>

                            <p>create a trip name.</p>
                            <label class="login-items">
                                <input type="text" name="trip_name" placeholder="e.g. Sunny Barcelona" required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                            </label><br>

                            <p>create a trip description.</p>
                            <label class="login-items">
                                <input type="text" name="description" placeholder="e.g. Enjoy the sun and sea in Spain."
                                    required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                            </label><br>

                            <p>choose a flight.</p>
                            <label class="login-items">
                                <select name="flights" required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                                    <option value="">empty</option>
                                    <?php foreach ($flights as $fli): ?>
                                        <option value="<?= $fli['flight_id'] ?>">
                                            <?= htmlspecialchars($fli['departure_airport'] . ' to ' . $fli['arrival_airport']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </label><br>

                            <label class="login-button hover-pointer">
                                <input type="submit" value="create" class="input-inline login-input">
                            </label><br>

                        </div>
                    </div>
                </form>
            </div>

            <div class="login-box">
                <h2>Create Flight</h2>

                <form action="../dbcalls/create_flight.php" method="post" class="login">

                    <p>create an airline.</p>
                    <label class="login-items">
                        <input type="text" name="airline" placeholder="e.g. Lufthansa" required
                            class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                    </label><br>

                    <p>choose a departure airport.</p>
                    <label class="login-items">
                        <select name="departure_airport" required
                            class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                            <option value="">empty</option>
                            <?php foreach ($locations as $loc): ?>
                                <option value="<?= $loc['country_id'] ?>">
                                    <?= htmlspecialchars($loc['city_name'] . " in " . $loc['country_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label><br>

                    <p>choose an arrival airport.</p>
                    <label class="login-items">
                        <select name="arrival_airport" required
                            class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                            <option value="">empty</option>
                            <?php foreach ($locations as $loc): ?>
                                <option value="<?= $loc['country_id'] ?>">
                                    <?= htmlspecialchars($loc['city_name'] . " in " . $loc['country_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label><br>

                    <p>choose a departure date.</p>
                    <label class="login-items">
                        <input type="datetime-local" name="departure_date" placeholder="empty" required
                            class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                    </label><br>

                    <p>choose an arrival date.</p>
                    <label class="login-items">
                        <input type="datetime-local" name="arrival_date" placeholder="empty" required
                            class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                    </label><br>

                    <p>set a price.</p>
                    <label class="login-items">
                        <input type="number" name="price" placeholder="e.g. 150.00" required
                            class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                    </label><br>

                    <label class="login-button hover-pointer">
                        <input type="submit" value="create" class="input-inline login-input">
                    </label><br>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>
</body>

</html>