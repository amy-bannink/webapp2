<?php
session_start();
include('./dbcalls/read-profile.php');


$user_id = $_SESSION['user_id'];

$success = '';
$error = '';

if (isset($_GET['success'])) {
    $success = "Profile updated successfully!";
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
    <title>Profile</title>
</head>

<body>

    <header class="profile">

        <?php include('./includes/small-header.php'); ?>
    </header>

    <main>
        <div class="login-wrapper">
            <div class="login-box">
                <h2>Your Profile</h2>

                <?php if ($success): ?>
                    <p style="color: green;"><?php echo $success; ?></p>
                <?php elseif ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>


                <form method="post" action="./dbcalls/update-profile.php" class="login">
                    <p>Your name.</p>
                    <label class="login-items">
                        <input type="text" name="name" placeholder="Name"
                            class="login-input-inline login-input normal-hover-pointer"
                            value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>">
                    </label><br>
                    <p>Your email.</p>
                    <label class="login-items">
                        <input type="email" name="email" placeholder="Email"
                            class="login-input-inline login-input normal-hover-pointer"
                            value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                    </label><br>

                    <p>Your phone number.</p>
                    <label class="login-items">
                        <input type="number" name="phone" placeholder="Phone"
                            class="login-input-inline login-input normal-hover-pointer"
                            value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                    </label><br>

                    <p>Your address.</p>
                    <label class="login-items">
                        <input type="text" name="address" placeholder="Address"
                            class="login-input-inline login-input normal-hover-pointer"
                            value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
                    </label><br>
                    <label class="login-button hover-pointer">
                        <input type="submit" value="Update" class="input-inline login-input">
                    </label><br>
                </form>

                <form method="post" action="./logout.php" class="login">
                    <label class="login-button hover-pointer">
                        <input type="submit" value="Log out" class="input-inline login-input">
                    </label>
                </form>
            </div>
        </div>
        <?php include('./dbcalls/read-order.php'); ?>
        <section class="profile-orders">
            <h2 class="your-orders-title">Your orders</h2>
            <div class="your-orders">
            <?php
            if (count($orders) < 1) {
                echo '<div class="order-item"><p><strong>No orders yet.</strong></p></div';
            } else {
                // var_dump($orders);
                foreach ($orders as $orderedTrip) {

                    echo '<div class="order-item">
                    <p><strong>Order date: </strong>' . $orderedTrip['order_date'] . '</p>
                    <p><strong>Status: </strong>' . $orderedTrip['status'] . '</p>
                    <p><strong>Guests: </strong>' . $orderedTrip['guests'] . '</p>
                    <p><strong>Total price: </strong>' . $orderedTrip['price_total'] . '</p>

                    
                    <a href="trip.php?id=' . $orderedTrip['trip_id'] . '"class="grid-link order-link">
        <div class="grid-item">
                <img src="' . $orderedTrip['location_img'] . '" alt="' . $orderedTrip['city_name'] . '">
                <div class="label">
                    <strong>' . $orderedTrip['trip_name'] . '</strong><br>';

                    $accommodationPrice = (float) $orderedTrip['price_per_night'];
                    $flightPrice = !empty($orderedTrip['price']) ? (float) $orderedTrip['price'] : 0;
                    $totalPrice = $accommodationPrice + $flightPrice;

                    echo 'Vanaf: €' . number_format($totalPrice, 0, ',', '.') . '<br>';

                    if (!empty($orderedTrip['departure_airport']) && !empty($orderedTrip['arrival_airport'])) {
                        echo '✈️ ' . $orderedTrip['departure_airport'] . ' → ' . $orderedTrip['arrival_airport'];
                    } else {
                        echo '🏡 Accommodatie zonder vlucht';
                    }

                    echo '</div>
            </div>
            </a>
            </div>';
                }
            }
            ?>
</div>
        </section>


    </main>

    <footer>
        <?php include('./includes/footer.php'); ?>
    </footer>
</body>

</html>