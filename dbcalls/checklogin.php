<?php
session_start();
include("conn.php");
$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password;");
$stmt->bindParam(":email", $_POST['email']);
$stmt->bindParam(":password", $_POST['password']);
$stmt->execute();
$result = $stmt->fetch();

if ($result) {
    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['role_id'] = $result['role_id'];
    header('location: ../index.php');
} else {
    $_SESSION['error'] = "Incorrect email or password.";
    header("Location: ../login.php");
    exit;
}