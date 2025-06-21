<?php session_start();

include('./dbcalls/read-admin.php');
include('./dbcalls/read-message.php');
// include('./dbcalls/update-message.php');



$readMessages = array_filter($result, fn($msg) => $msg['status'] === 'read');
$unreadMessages = array_filter($result, fn($msg) => $msg['status'] === 'unread');

$readIndex = isset($_GET['read_index']) ? (int) $_GET['read_index'] : 0;
$unreadIndex = isset($_GET['unread_index']) ? (int) $_GET['unread_index'] : 0;

$readMessage = array_values($readMessages)[$readIndex] ?? null;
$unreadMessage = array_values($unreadMessages)[$unreadIndex] ?? null;

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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


        <div class="create-wrapper admin-create-section">
            <div class="wide-login-box">
                <form action="../dbcalls/create_trip.php" method="post" enctype="multipart/form-data">
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
                        <input type="submit" value="create" class="input-inline login-input">
                    </label><br>
                </form>
            </div>
        </div>




        <div class="admin-messages">


            <section class="admin-read-messages">
                <h2>Read messages</h2>
                <?php
                if (isset($_GET['message']) && $_GET['message'] === 'deleted') {
                    echo "<p style='color: red;'>Bericht succesvol verwijderd.</p>";
                }
                ?>
                <?php if ($readMessage): ?>
                    <div class="admin-received-message">
                        <p><strong>Name:</strong>
                            <?= htmlspecialchars($readMessage['first_name'] . ' ' . $readMessage['last_name']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($readMessage['email']) ?></p>
                        <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($readMessage['message'])) ?></p>
                        <p><strong>Sent at:</strong> <?= htmlspecialchars($readMessage['sent_at']) ?></p>

                        <!-- <form method="post" action="reply.php">
                            <textarea name="reply_message" class="admin-reply-message" placeholder="Write a reply..."
                                required></textarea>
                            <input type="hidden" name="contact_id" value="<?= $readMessage['contact_id'] ?>">
                            <button type="submit" class="send-reply-btn">Send reply</button>
                        </form> -->

                        <form method="post" action="/dbcalls/delete-message.php"
                            onsubmit="return confirm('Are  you sure you want to delete this message?');">
                            <input type="hidden" name="contact_id" value="<?= $readMessage['contact_id'] ?>">
                            <button type="submit" class="delete-message-btn">Delete message</button>
                        </form>
                    </div>

                    <div class="nav-buttons">
                        <?php if ($readIndex > 0): ?>
                            <a href="?read_index=<?= $readIndex - 1 ?>&unread_index=<?= $unreadIndex ?>">← Previous</a>
                        <?php endif; ?>
                        <?php if ($readIndex < count($readMessages) - 1): ?>
                            <a href="?read_index=<?= $readIndex + 1 ?>&unread_index=<?= $unreadIndex ?>">Next →</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p>No read messages.</p>
                <?php endif; ?>
            </section>

            <section class="admin-unread-messages">
                <h2>Unread messages</h2>
                <?php if ($unreadMessage): ?>
                    <div class="admin-received-message">
                        <p><strong>Name:</strong>
                            <?= htmlspecialchars($unreadMessage['first_name'] . ' ' . $unreadMessage['last_name']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($unreadMessage['email']) ?></p>
                        <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($unreadMessage['message'])) ?></p>
                        <p><strong>Sent at:</strong> <?= htmlspecialchars($unreadMessage['sent_at']) ?></p>
                        <form method="post" action="./dbcalls/update-message.php"
                            onsubmit="return confirm('Mark this message as read?');">
                            <input type="hidden" name="contact_id" value="<?= $unreadMessage['contact_id'] ?>">
                            <button type="submit" class="mark-read-btn">Mark as read</button>
                        </form>

                        <!-- <form method="post" action="reply.php">
                            <textarea name="reply_message" class="admin-reply-message" placeholder="Write a reply..."
                                required></textarea>
                            <input type="hidden" name="contact_id" value="<?= $unreadMessage['contact_id'] ?>">
                            <button type="submit" class="send-reply-btn">Send reply</button>
                        </form> -->

                        <form method="post" action="/dbcalls/delete-message.php"
                            onsubmit="return confirm('Are  you sure you want to delete this message?');">
                            <input type="hidden" name="contact_id" value="<?= $unreadMessage['contact_id'] ?>">
                            <button type="submit" class="delete-message-btn">Delete message</button>
                        </form>
                    </div>

                    <div class="nav-buttons">
                        <?php if ($unreadIndex > 0): ?>
                            <a href="?read_index=<?= $readIndex ?>&unread_index=<?= $unreadIndex - 1 ?>">← Previous</a>
                        <?php endif; ?>
                        <?php if ($unreadIndex < count($unreadMessages) - 1): ?>
                            <a href="?read_index=<?= $readIndex ?>&unread_index=<?= $unreadIndex + 1 ?>">Next →</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p>No unread messages.</p>
                <?php endif; ?>
            </section>

        </div>






    </main>

    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>
</body>

</html>