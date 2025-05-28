<?php
include('./conn.php');

$trip_id = $_POST['ID'];


$stmt = $conn->prepare("DELETE FROM trips WHERE ID=:ID");
$stmt->bindParam(":ID", $id);
$stmt->execute();

header("location: ../admin.php");   