<?php
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
if (isset($_SESSION['user_id'])) {
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
        include('./includes/small-header.php');
        ?>
    </header>

    <main>
        <div class="login-wrapper">
            <div class="login-box">
                <form method="post" action="./dbcalls/checklogin.php" class="login">
                    <p>Log in with your e-mail and password.</p>

                    <?php if (!empty($error)): ?>
                        <div style="color: red; margin-bottom: 10px;">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <label class="login-items">
                        <input type="text" name="email" placeholder="e-mail" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-items">
                        <input type="password" name="password" placeholder="Password" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <p>I don't have an account yet.</p>
                    <a href="../sign_up.php" class="normal-hover-pointer redirect-login-sign_up">go to sign up</a>

                    <div class="login-button-wrapper">
                        <div>
                            <br><a href="../forgot_password.php" class="hover-pointer redirect-login-sign_up">I forgot
                                my password</a>

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