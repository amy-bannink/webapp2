<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Sign_up</title>
</head>

<body>

    <header class="sign-up">
        <?php
        include('./includes/small_header.php');
        ?>
    </header>


    <main>
        <div class="login-wrapper">
            <div class="login-box">
                <form method="post" action="./dbcalls/register.php" class="login">
                    <p>Sign up with your e-mail and password.</p>

                    <label class="login-items">
                        <input type="text" name="full_name" placeholder="Full Name"
                            class="input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-items">
                        <input type="text" name="email" placeholder="E-mail"
                            class="input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-items">
                        <input type="password" name="password" placeholder="Password"
                            class="input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-items">
                        <input type="password" name="confirm_password" placeholder="Password"
                            class="input-inline login-input normal-hover-pointer">
                    </label>

                    <div class="login-button-wrapper">
                        <div>
                            <p>Already have an account?</p>
                            <a href="../login.php" class="hover-pointer redirect-login-sign_up">Go to login</a>
                        </div>
                        <label class="login-button hover-pointer">
                            <input type="submit" value="Sign up" class="input-inline login-input">
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