<?php

include("./conn.php");
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = 'INSERT INTO contact(first_name, last_name, email, message) VALUES (:first_name, :last_name, :email, :message);';
$stmt = $conn->prepare($sql);
$stmt->bindParam("first_name", $firstname);
$stmt->bindParam("last_name", $lastname);
$stmt->bindParam("email", $email);
$stmt->bindParam("message", $message);
$executed = $stmt->execute();

if ($executed) {
    header("Location: ../contact.php?status=success");
    exit;
} else {
    header("Location: ../contact.php?status=error");
    exit;
}
?>
