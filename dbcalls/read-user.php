<?php

$stmt = $conn->prepare("SELECT email, name, password, phone, address FROM users;");
$stmt->execute();
$result = $stmt->fetchAll();