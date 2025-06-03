<?php

$stmt = $conn->prepare("SELECT * FROM trips;");
$stmt->execute();
$result = $stmt->fetchAll();