<?php
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Forgot_password</title>
</head>

<body>

    <header>
        <?php
        include('./includes/empty_header.php');
        ?>
    </header>

    <main>
        <div class="login-wrapper">
            <div class="login-box">
                <p>Reset Your Password.</p>

                <?php if (!empty($error)): ?>
                    <div style="color: red; margin-bottom: 10px;">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="./dbcalls/reset_password.php" class="login">
                    <label class="login-items">
                        <input type="email" name="email" placeholder="Email" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-items">
                        <input type="password" name="new_password" placeholder="New Password" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-items">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required
                            class="login-input-inline login-input normal-hover-pointer">
                    </label>

                    <label class="login-button hover-pointer">
                        <input type="submit" value=" Reset" class="input-inline login-input">
                    </label>
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