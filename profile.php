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

if (isset($_GET['order']) && $_GET['order'] === 'deleted') {
    $orderSuccess = "Order successfully cancelled.";
}

$orderError = '';
if (isset($_GET['order']) && $_GET['order'] === 'delete_failed') {
    $orderError = "Something went wrong with canceling your order.";
}

$statusMessage = '';
$updatedOrderId = $_GET['updated_id'] ?? null;

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'updated') {
        $statusMessage = 'Status succesvol bijgewerkt.';
    } elseif ($_GET['status'] === 'failed') {
        $statusMessage = 'Bijwerken van de status is mislukt.';
    }
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
            <?php if (!empty($orderSuccess)): ?>
                <p style="color: green;"><?php echo $orderSuccess; ?></p>
            <?php endif; ?>
            <?php if (!empty($orderError)): ?>
                <p style="color: red;"><?php echo $orderError; ?></p>
            <?php endif; ?>

            <div class="your-orders">
                <?php if (count($orders) < 1): ?>
                    <div class="order-item"><p><strong>No orders yet.</strong></p></div>
                <?php else: ?>
                    <?php foreach ($orders as $orderedTrip): ?>
                        <div class="order-item">
                            <p><strong>Order date: </strong> <?php echo $orderedTrip['order_date']; ?></p>
                            <p><strong>Status: </strong> <?php echo $orderedTrip['status']; ?></p>

                            <?php if ($updatedOrderId == $orderedTrip['order_id']): ?>
                                <?php $color = ($_GET['status'] === 'updated') ? 'green' : 'red'; ?>
                                <p style="color: <?php echo $color; ?>;"><?php echo $statusMessage; ?></p>
                            <?php endif; ?>

                            <p><strong>Guests: </strong> <?php echo $orderedTrip['guests']; ?></p>
                            <p><strong>Total price: </strong> €<?php echo number_format($orderedTrip['price_total'], 0, ',', '.'); ?></p>

                            <a href="trip.php?id=<?php echo $orderedTrip['trip_id']; ?>" class="grid-link order-link">
                                <div class="grid-item">
                                    <img src="<?php echo $orderedTrip['location_img']; ?>" alt="<?php echo $orderedTrip['city_name']; ?>">
                                    <div class="label">
                                        <strong><?php echo $orderedTrip['trip_name']; ?></strong><br>
                                        <?php
                                            $accommodationPrice = (float) $orderedTrip['price_per_night'];
                                            $flightPrice = !empty($orderedTrip['price']) ? (float) $orderedTrip['price'] : 0;
                                            $totalPrice = $accommodationPrice + $flightPrice;
                                        ?>
                                        Vanaf: €<?php echo number_format($totalPrice, 0, ',', '.'); ?><br>
                                        <?php if (!empty($orderedTrip['departure_airport']) && !empty($orderedTrip['arrival_airport'])): ?>
                                            ✈️ <?php echo $orderedTrip['departure_airport']; ?> → <?php echo $orderedTrip['arrival_airport']; ?>
                                        <?php else: ?>
                                            🏡 Accommodatie zonder vlucht
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>

                            <form method="post" class="order-actions">
                                <input type="hidden" name="order_id" value="<?php echo $orderedTrip['order_id']; ?>">
                                <button type="submit" formaction="./dbcalls/delete-order.php" class="cancel-button hover-pointer">Cancel trip</button>
                                <button type="submit" formaction="./dbcalls/update-order.php" class="pay-button hover-pointer">Pay order</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <?php include('./includes/footer.php'); ?>
    </footer>
</body>

</html>
