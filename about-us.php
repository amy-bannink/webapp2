<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>About Us</title>
</head>

<body>

    <header class="about-us">
        <?php
        include('./includes/header.php');
        ?>
    </header>

    <main class="about-us-main">
        <div class="about-us-div">
            <h1>About Us</h1>
            <br>
            <P>Welcome to Route Scout, your trusted partner for unforgettable journeys. With years of experience in the
                travel industry, we are dedicated every day to crafting the best vacations and travel experiences for
                you.
                <br>
                <br>
                Our mission is clear: to make travel accessible with personalized service and a keen eye for quality.
                Whether you dream of an adventurous tour, a relaxing beach holiday, or a cultural city break, we are
                happy to assist you and ensure a hassle-free preparation.
                <br>
                <br>
                At Route Scout, reliability, customer satisfaction, and sustainability are at the heart of everything we
                do. We work exclusively with carefully selected partners to ensure your trip is perfectly arranged. Our
                team of experienced travel experts is always ready to advise and support you.
                <br>
                <br>
                Choose Route Scout and experience the ease and confidence of traveling with a partner who truly thinks
                along with you. We look forward to planning the perfect trip together!
        </div>
    </main>

    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>
</body>

</html>