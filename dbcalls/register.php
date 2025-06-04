<?php
session_start();
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';
    $confirm_password = $_POST["confirm_password"] ?? '';

    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../sign_up.php");
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: ../sign_up.php");
        exit;
    }
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: ../sign_up.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Email is already registerd.";
        header("Location: ../sign_up.php");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$full_name, $email, $password, 2])) {
        $user_id = $conn->lastInsertId();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $full_name;
        $_SESSION['email'] = $email;

        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
        header("Location: ../sign_up.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../sign_up.php");
    exit;
}


