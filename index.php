<?php session_start();?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Index</title>
</head>
<body>

    <header class="index">
        <?php
        
            include('./includes/header.php');
            ?>
    </header>

    <main>
        <?php
        include('./dbcalls/conn.php');
        ?>
    </main>

    <footer>
        <?php
            include('./includes/footer.php');
            ?>
    </footer>
</body>
</html>