<?php
include("./dbcalls/conn.php");

$stmt = $conn->prepare(query: "SELECT * FROM locations ORDER BY country_name ASC, city_name ASC;");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);