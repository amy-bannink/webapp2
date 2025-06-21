<?php
include 'conn.php';

$stmt = $conn->prepare( "SELECT * FROM contact ORDER BY sent_at ASC");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>