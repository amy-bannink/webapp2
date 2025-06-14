<?php
include("conn.php");

$searchTerm = isset($_GET['search-locations']) ? trim($_GET['search-locations']) : '';

if ($searchTerm !== '') {
    $searchTermLower = strtolower($searchTerm);

    $stmt = $conn->prepare("
        SELECT * FROM locations
        WHERE LOWER(city_name) LIKE :search OR LOWER(country_name) LIKE :search
        ORDER BY country_name ASC, city_name ASC
    ");

    $stmt->execute(['search' => "%$searchTermLower%"]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: locations.php");
    exit;
}
?>