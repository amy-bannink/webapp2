<?php
session_start();
include('./dbcalls/conn.php');

$user_id = $_SESSION['user_id'];
$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $phone = trim($_POST["phone"] ?? '');
    $address = trim($_POST["address"] ?? '');

    if (empty($name) || empty($email)) {
        $error = "Name and email are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE user_id = ?");
        if ($stmt->execute([$name, $email, $phone, $address, $user_id])) {
            $success = "Profile updated successfully!";
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
        } else {
            $error = "Failed to update profile.";
        }
    }
}

$stmt = $conn->prepare("SELECT name, email, phone, address FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profile</title>
</head>

<body>

    <header class="profile">
        <?php include('./includes/small_header.php'); ?>
    </header>

    <main>
        <div class="login-wrapper">
            <div class="login-box">
                <h2>Your Profile</h2>

                <?php if ($success): ?>
                    <p style="color: green;"><?php echo $success; ?></p>
                <?php elseif ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <form method="post" class="login">
                    <p>Your name.</p>
                    <label class="login-items">
                        <input type="text" name="name" placeholder="Name" class="login-input-inline login-input normal-hover-pointer"
                            value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>">
                    </label><br>

                    <p>Your email.</p>
                    <label class="login-items">
                        <input type="email" name="email" placeholder="Email" class="login-input-inline login-input normal-hover-pointer"
                            value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                    </label><br>

                    <p>Your phone number.</p>
                    <label class="login-items">
                        <input type="number" name="phone" placeholder="Phone" class="login-input-inline login-input normal-hover-pointer"
                            value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                    </label><br>
                    
                    <p>Your address.</p>
                    <label class="login-items">
                        <input type="text" name="address" placeholder="Address" class="login-input-inline login-input normal-hover-pointer"
                            value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
                    </label><br>
                    
                    <label class="login-button hover-pointer">
                        <input type="submit" value="Update" class="input-inline login-input">
                    </label><br>
                </form>

                <form method="post" action="./logout.php" class="login">
                    <label class="login-button hover-pointer">
                        <input type="submit" value="Log out" class="input-inline login-input">
                    </label>
                </form>
            </div>
        </div>

    </main>

    <footer>
        <?php include('./includes/footer.php'); ?>
    </footer>
</body>

</html>