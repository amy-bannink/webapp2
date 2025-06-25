<?php
include('conn.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = (int)$_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET status = 'payed' WHERE order_id = ?");

    if ($stmt->execute([$order_id])) {
        header("Location: ../profile.php?status=updated&updated_id=" . $order_id);
        exit;
    } else {
        header("Location: ../profile.php?status=failed&updated_id=" . $order_id);
        exit;
    }
} else {
    header("Location: ../profile.php");
    exit;
}
