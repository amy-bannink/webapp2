<?php session_start();
include('./dbcalls/conn.php');

// Fetch all trips
$stmt = $conn->query("SELECT * FROM trips");
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all accomodations
$acc_stmt = $conn->query("SELECT accommodation_id, name FROM accommodations");
$accommodations = $acc_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all flights
$fli_stmt = $conn->query("SELECT flight_id, airline FROM flights");
$flights = $fli_stmt->fetchAll(PDO::FETCH_ASSOC);
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
        include('./includes/small_header.php');
        ?>
    </header>


    <main>
        <div class="create-wrapper">
            <div class="login-box">
                <h1 class="create-title">Create Trip</h1>
                <form action="./dbcalls/create_trip.php" method="post" class="login">

                    <p>Trip name:</p>
                    <label class="login-items">
                        <input type="text" name="trip_name" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Description:</p>
                    <label class="login-items">
                        <input type="text" name="description" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Choose flight:</p>
                    <label class="login-items">
                        <select name="flight_id" id="" required
                            class="login-input-inline login-input normal-hover-pointer">
                            <option value="">-- Choose --</option>
                            <?php foreach ($flights as $fli): ?>
                                <option value="<?= $fli['flight_id'] ?>">
                                    <?= htmlspecialchars($fli['airline']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <p>Choose accomodation:</p>
                    <label class="login-items">
                        <select name="accomodation_id" id="" required
                            class="login-input-inline login-input normal-hover-pointer">
                            <option value="">-- Choose --</option>
                            <?php foreach ($accommodations as $acc): ?>
                                <option value="<?= $acc['accommodation_id'] ?>">
                                    <?= htmlspecialchars($acc['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label class="login-button hover-pointer">
                        <input type="submit" value="Create" class="input-inline login-input">
                    </label>
                </form>
            </div>
            <div class="login-box">
                <h1 class="create-title">Create Flight</h1>
                <form action="./dbcalls/create_flight.php" method="post" class="login">

                    <p>Airline:</p>
                    <label class="login-items">
                        <input type="text" name="airline" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Departure airport:</p>
                    <label class="login-items">
                        <input type="text" name="departure_airport" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Arrival airport:</p>
                    <label class="login-items">
                        <input type="text" name="arrival_airport" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Departure date:</p>
                    <label class="login-items">
                        <input type="date" name="departure_date" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Arrival date:</p>
                    <label class="login-items">
                        <input type="date" name="arrival_date" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Price:</p>
                    <label class="login-items">
                        <input type="number" name="price" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-button hover-pointer">
                        <input type="submit" value="Create" class="input-inline login-input">
                    </label>
                </form>
            </div>
            <div class="login-box">
                <h1 class="create-title">Create Accomodation</h1>
                <form action="./dbcalls/create_accomodation.php" method="post" class="login">

                    <p>Accomodation name:</p>
                    <label class="login-items">
                        <input type="text" name="accommodation_id" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Country:</p>
                    <label class="login-items">
                        <input type="text" name="country_id" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Description:</p>
                    <label class="login-items">
                        <input type="text" name="discription" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Price per night:</p>
                    <label class="login-items">
                        <input type="number" name="price_per_night" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>Max guests:</p>
                    <label class="login-items">
                        <input type="number" name="max_guests" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-button hover-pointer">
                        <input type="submit" value="Create" class="input-inline login-input">
                    </label>
                </form>
            </div>
        </div>

        <!-- <hr>
        <h1>Existing Trips</h1>
        <?php foreach ($trips as $trip): ?>
            <div class="trip-item">
                <form action="./dbcalls/update_trip.php" method="post">
                    <input type="hidden" name="trip_id" value="<?= $trip['trip_id'] ?>">

                    <label>Accommodation ID:</label>
                    <input type="text" name="accommodation_id" value="<?= $trip['accommodation_id'] ?>">

                    <label>Flight ID:</label>
                    <input type="text" name="flight_id" value="<?= $trip['flight_id'] ?>">

                    <button type="submit">Update</button>
                </form>

                <form action="./dbcalls/delete_trip.php" method="post" style="margin-top: 5px;">
                    <input type="hidden" name="trip_id" value="<?= $trip['trip_id'] ?>">
                    <input type="submit" value="Delete" style="color: red;">
                </form>
            </div>
            <hr>
        <?php endforeach; ?> -->
    </main>

    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>
</body>

</html>