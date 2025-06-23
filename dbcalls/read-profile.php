<?php
session_start();
include('conn.php');

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    http_response_code(401);
    exit('Unauthorized');
}

$stmt = $conn->prepare("SELECT name, email, phone, address FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);
