<?php
session_start();
    if (isset($_SESSION['user_id']) ){
        header('location: profile.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>

<body>

    <header>
        <?php
        include('./includes/small_header.php');
        ?>
    </header>



    <main>
        <div class="login-wrapper">
            <div class="login-box">
                <form method="post" action="./dbcalls/checklogin.php" class="login">
                    <p>Log in with your e-mail and password.</p>

                    <label class="login-items">
                        <input type="text" name="email" placeholder="e-mail"
                            class="input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-items">
                        <input type="password" name="password" placeholder="Password"
                            class="input-inline login-input normal-hover-pointer">
                    </label>

                    <div class="login-button-wrapper">
                        <div>
                            <p>I don't have an account yet.</p>
                            <a href="../sign_up.php" class="hover-pointer redirect-login-sign_up">go to sign up</a>
                        </div>
                        <label class="login-button hover-pointer">
                            <input type="submit" value="Log in" class="input-inline login-input">
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