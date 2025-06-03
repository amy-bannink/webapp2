<?php
session_start();
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';
    $confirm_password = $_POST["confirm_password"] ?? '';

    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        die("Email is already registered.");
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$full_name, $email, $password, 2])) {
        $user_id = $conn->lastInsertId();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $full_name;
        $_SESSION['email'] = $email;

        header("Location: ../dashboard.php");
        exit;
    } else {
        die("Something went wrong. Please try again.");
    }
} else {
    die("Invalid request.");
}


