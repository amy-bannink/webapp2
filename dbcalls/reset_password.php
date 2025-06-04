<?php
session_start();
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($email) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../forgot_password.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: ../forgot_password.php");
        exit;
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../forgot_password.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "No account found with that email.";
        header("Location: ../forgot_password.php");
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    if ($stmt->execute([$new_password, $email])) {
        header('location: ../login.php');
    } else {
        $_SESSION['error'] = "Failed to update password.";
    }
} else {
    die("Invalid request.");
}
