<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>profile</title>
</head>
<body>

    <header class="profile">
        <?php
            include('./includes/small_header.php');
            ?>
    </header>


    <main>
        <div class="login-wrapper">
            <div class="login-box">
                < method="post" action="../logout.php" class="login">
                    <?php
                    include('./dbcalls/conn.php');
                    ?>
                    
                    <div class="login-button-wrapper">
                        <label class="login-button hover-pointer">
                            <input type="submit" value="Log out" class="input-inline login-input">
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php
            include('./includes/footer.php');
            ?>
    </footer>
</body>
</html>