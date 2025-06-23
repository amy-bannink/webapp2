<?php session_start(); ?>
<?php
include('./dbcalls/read-location-details.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Location Details</title>
</head>

<body>

    <header class="locations">
        <?php
        include('./includes/header.php');
        ?>
    </header>

    <main class="main-location-details">
        <?php if ($location): ?>
            <section class="location-info">
                <h1><?php echo htmlspecialchars($location['city_name'] . ', ' . $location['country_name']); ?></h1>
                <img class="location-details-img" src="<?php echo htmlspecialchars($location['location_img']); ?>"
                    alt="Foto van <?php echo htmlspecialchars($location['city_name']); ?>">
                <p><strong>Region:</strong> <?php echo htmlspecialchars($location['region']); ?></p>
                <p><strong>About <?php echo $location['city_name'] . ', ' . $location['country_name'] . ': ' ?></strong>
                    <?php echo htmlspecialchars($location['description']); ?></p>
                <p><strong>Highlights:</strong> <?php echo htmlspecialchars($location['highlights']); ?></p>
                <p><strong>Climate:</strong> <?php echo htmlspecialchars($location['climate']); ?></p>
            </section>
        <?php else: ?>
            <p>Geen locatiegegevens beschikbaar.</p>
        <?php endif; ?>
    </main>


    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>
</body>

</html>