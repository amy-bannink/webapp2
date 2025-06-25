<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = (int) $_POST['order_id'];

    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");

    if ($stmt->execute([$order_id])) {
        header("Location: ../profile.php?order=deleted");
        exit;
    } else {
        header("Location: ../profile.php?order=delete_failed");
        exit;
    }
} else {
    header("Location: ../profile.php");
    exit;
}
?>