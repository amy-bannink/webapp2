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
                <form action="" class="login">
                    <p>Sign up with your e-mail and password.</p>
                    <label class="login-items">
                        <input type="text" placeholder="e-mail" id="email" class="input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-items">
                        <input type="text" placeholder="Password" id="password" class="input-inline login-input normal-hover-pointer">
                    </label>
                    <p>I already have an account.</p>
                </form>
                <a href="../login.php" class="hover-pointer redirect-login-sign_up">go to login</a>
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