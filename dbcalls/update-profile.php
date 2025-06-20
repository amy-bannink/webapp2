<?php
session_start();
include('../dbcalls/conn.php'); // pad klopt als dit bestand in /dbcalls staat

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
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            header("Location: ../profile.php?success=1");
            exit;
        } else {
            header("Location: ../profile.php?error=1");
            exit;
        }
    }
    // Als er fout is, terugsturen met foutmelding
    header("Location: ../profile.php?error=" . urlencode($error));
    exit;
}
