<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Locations</title>
</head>

<body>

    <header class="locations">
        <?php
        include('./includes/header.php');
        ?>
    </header>

    <main class="main-locations">
        <section class="intro-section-locations">
            <h1 class="title">Explore Our Exclusive European Destinations</h1>
            <p class="text">
                Discover detailed information about the unique locations where we offer carefully curated accommodations
                and trips.
                We specialize exclusively in Europe, bringing you authentic experiences and unforgettable journeys
                across some of the continent’s most iconic cities and hidden gems.
                Whether you’re seeking vibrant urban escapes, scenic coastal retreats, or cultural landmarks, our
                selection covers a diverse range of travel interests.
            </p>
        </section>
        <section class="search-section">
            <form action="locations.php" method="GET" class="search-form">
                <input class="search-locations-input" type="text" name="search-locations" placeholder="Search destinations by city or country..."
                    aria-label="Search destinations"
                    value="<?php echo isset($_GET['search-locations']) ? htmlspecialchars($_GET['search-locations']) : ''; ?>">
                <button type="submit" class="search-locations-button">Search</button>
            </form>
        </section>




        <section class="locations-grid">
            <?php
            include('./dbcalls/conn.php');
            if (isset($_GET['search-locations']) && trim($_GET['search-locations']) !== '') {
                include('./dbcalls/search-locations.php');
            } else {
                include('./dbcalls/read-locations.php');
            }
            if (!empty($result) && is_array($result)) {
                foreach ($result as $location) {
                    echo '<a href="location-details.php?id=' . $location['location_id'] . '" class="grid-link">
                    <div class="grid-item">
                <img src="' . $location['location_img'] . '" alt="' . $location['city_name'] . '">
                <div class="label">
                    <strong>' . $location['country_name'] . ', ' . $location['city_name'] . '</strong><br>' .
                        '</div></div></a>';
                }
            } else {
                echo "<p>No locations found.</p>";
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