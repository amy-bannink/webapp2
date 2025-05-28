<?php
include("conn.php");

$searchResult = $_GET["searchresult"];

$trip = '%' . $searchResult . '%';

$stmt = $conn->prepare("SELECT * FROM trips WHERE lower(trip_name) LIKE lower(:trip);");
$stmt->bindParam(":trip", $trip);
$stmt->execute();

$searchResult = $stmt->fetchAll();

session_start();
$_SESSION["searchResult"] = $searchResult;

header("location: ../index.php");