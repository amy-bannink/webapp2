<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Contact</title>
</head>

<body>

    <header class="contact">
        <?php
        include('./includes/header.php');
        ?>
    </header>

    <main class="contact-main">
        <div class="contact-div">
            <h1>Contact Us</h1>
            <p>Scout the way. Embrace the journey.</p>


            <P>Have a question about your next trip? Want to know more about our travel packages? We're here to help!
                <br>
                <br>
                You can reach out to our friendly team any time. Whether you need help with booking, want to plan a
                custom adventure, or just have a quick question — we’re happy to hear from you.
        </div>
        <section>
            <div class="contact-form-area">
                <h1>Send Us A Message</h1>
                <form class="contact-form" action="./dbcalls/send-contact-form.php" method="post">
                    <input class="contact-form-input" type="text" name="first_name" placeholder="First name" required>
                    <input class="contact-form-input" type="text" name="last_name" placeholder="Surname" required>
                    <input class="contact-form-input" type="email" name="email" placeholder="Email address" required>
                    <textarea class="contact-form-input" name="message" rows="13" cols="50" placeholder="Your message"
                        required></textarea>
                    <button type="submit" value="Submit" class="submit-button">Verstuur</button>
                </form>
            </div>
        </section>

    </main>

    <footer>
        <?php
        include('./includes/footer.php');
        ?>
    </footer>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'success') {
            alert("Bericht verstuurd! We nemen zo snel mogelijk contact met je op.");
        }
        if (status === 'error') {
            alert("Er is een fout opgetreden. Probeer het opnieuw.");
        }
    </script>
</body>

</html>