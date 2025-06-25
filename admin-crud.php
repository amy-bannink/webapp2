<?php session_start();

include('./dbcalls/read-admin.php');

$success = '';
$error = '';

if (isset($_GET['success'])) {
    $success = "Updated successfully!";
}

if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Admin crud</title>
</head>

<body>

    <header class="admin">
        <?php
        include('./includes/small-header.php');
        ?>
    </header>


    <main>
        <div class="admin-title">
            <a href="admin.php">
                <h2 class="hover-pointer">Administration</h2>
            </a>
            <a href="admin-crud.php">
                <h2 class="admin2-header hover-pointer">Crud system</h2>
            </a>
        </div>

        <div class="sepperator">
            <h2 class="sepperator-title">Create</h2>
        </div>

        <div class="create-wrapper admin-create-section">
            <div class="wide-login-box">
                <form action="../dbcalls/create-trip.php" method="post" enctype="multipart/form-data">
                    <div class="create-wrapper admin-create-section">
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
                                <select name="location_id" required
                                    class="login-input-inline login-input normal-hover-pointer grey-placeholder">
                                    <option value="">empty</option>
                                    <?php foreach ($locations as $loc): ?>
                                        <option value="<?= $loc['location_id'] ?>">
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
                                <input type="text" name="trip_description"
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
                                <input type="submit" value="create" class="input-inline login-input hover-pointer">
                            </label><br>

                        </div>
                    </div>
                </form>
            </div>

            <div class="login-box">
                <h2>Create Flight</h2>

                <form action="../dbcalls/create-flight.php" method="post" class="login">

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
                                <option value="<?= $loc['location_id'] ?>">
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
                                <option value="<?= $loc['location_id'] ?>">
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
                        <input type="submit" value="create" class="input-inline login-input hover-pointer">
                    </label><br>
                </form>
            </div>
        </div>

        <div class="sepperator margin-top">
            <h2 class="sepperator-title">Read/Update/Delete</h2>
        </div>

        <?php
        include('./dbcalls/read.php');
        ?>

        <h2>accomodations table</h2>
        <?php foreach ($accommodations as $row): ?>
            <form action="../dbcalls/update-accommodations.php" method="post" enctype="multipart/form-data"
                class="table-wrapper">

                <input type="hidden" name="accommodation_id" value="<?php echo ($row['accommodation_id']); ?>">

                <div class="table-column table-column-accommodations">
                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>"
                        class="normal-hover-pointer">
                </div>

                <div class="table-column table-column-accommodations">
                    <input type="text" name="location_id" value="<?php echo htmlspecialchars($row['location_id']); ?>"
                        class="normal-hover-pointer">
                </div>

                <div class="table-column table-column-accommodations">
                    <input type="text" name="image">
                    <?php if (!empty($row['image'])): ?>
                        <img src="../images/<?php echo htmlspecialchars($row['image']); ?>"
                            class="normal-hover-pointer">
                    <?php endif; ?>
                </div>

                <div class="table-column table-column-accommodations">
                    <input type="text" name="accommodation_description"
                        value="<?php echo htmlspecialchars($row['accommodation_description']); ?>"
                        class="normal-hover-pointer">
                </div>

                <div class="table-column table-column-accommodations">
                    <input type="number" name="price_per_night"
                        value="<?php echo htmlspecialchars($row['price_per_night']); ?>" class="normal-hover-pointer">
                </div>

                <div class="table-column table-column-accommodations">
                    <input type="number" name="max_guests" value="<?php echo htmlspecialchars($row['max_guests']); ?>"
                        class="normal-hover-pointer">
                </div>

                <button type="submit" name="action" value="update" class="table-column normal-hover-pointer">Update</button>

            </form>
        <?php endforeach; ?>



        <h2>trips table</h2>
        <?php foreach ($result as $row): ?>
            <form action="../dbcalls/update-delete-trips.php" method="post" class="table-wrapper">

                <input type="hidden" name="trip_id" value="<?php echo ($row['trip_id']); ?>">

                <div class="table-column table-column-trips">
                    <input type="text" name="trip_name" value="<?php echo htmlspecialchars($row['trip_name']); ?>"
                        class="normal-hover-pointer">
                </div>

                <div class="table-column table-column-trips">
                    <input type="text" name="trip_description"
                        value="<?php echo htmlspecialchars($row['trip_description']); ?>" class="normal-hover-pointer">
                </div>

                <div class="table-column table-column-trips">
                    <input type="number" name="flight_id" value="<?php echo htmlspecialchars($row['flight_id']); ?>"
                        class="normal-hover-pointer">
                </div>

                <div class="table-column table-column-trips">
                    <input type="number" name="accommodation_id"
                        value="<?php echo htmlspecialchars($row['accommodation_id']); ?>" class="normal-hover-pointer">
                </div>

                <button type="submit" name="action" value="update" class="table-column normal-hover-pointer">Update</button>
                <button type="submit" name="action" value="delete"
                    onclick="return confirm('Are you sure you want to delete this trip?')"
                    class="table-column normal-hover-pointer">Delete</button>

            </form>
        <?php endforeach; ?>


        <h2>flights table</h2>
        <?php foreach ($flights as $row): ?>
            
            <?php if (isset($row['flight_id'])) { ?>
                <form action="../dbcalls/update-delete-flights.php" method="post" class="table-wrapper">

                    <input type="hidden" name="flight_id" value="<?php echo $row['flight_id']; ?>">

                    <div class="table-column table-column-flights">
                        <input type="text" name="airline" value="<?php echo htmlspecialchars($row['airline']); ?>"
                            class="normal-hover-pointer">
                    </div>

                    <div class="table-column table-column-flights">
                        <input type="text" name="departure_airport"
                            value="<?php echo htmlspecialchars($row['departure_airport']); ?>" class="normal-hover-pointer">
                    </div>

                    <div class="table-column table-column-flights">
                        <input type="text" name="arrival_airport"
                            value="<?php echo htmlspecialchars($row['arrival_airport']); ?>" class="normal-hover-pointer">
                    </div>

                    <div class="table-column table-column-flights">
                        <input type="datetime-local" name="departure_date"
                            value="<?php echo htmlspecialchars($row['departure_date']); ?>" class="normal-hover-pointer">
                    </div>

                    <div class="table-column table-column-flights">
                        <input type="datetime-local" name="arrival_date"
                            value="<?php echo htmlspecialchars($row['arrival_date']); ?>" class="normal-hover-pointer">
                    </div>

                    <div class="table-column table-column-flights">
                        <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" step="0.01"
                            class="normal-hover-pointer">
                    </div>

                    <button type="submit" name="action" value="update" class="table-column normal-hover-pointer">Update</button>
                    <button type="submit" name="action" value="delete"
                        onclick="return confirm('Are you sure you want to delete this flight?')"
                        class="table-column normal-hover-pointer">Delete</button>

                </form>
            <?php } else {
                echo('test');
            } ?>
        <?php endforeach; ?>

    </main>

    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>
</body>

</html>