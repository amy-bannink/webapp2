<?php
include('conn.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_id'])) {
    $contact_id = (int)$_POST['contact_id'];

    $stmt = $conn->prepare("DELETE FROM contact WHERE contact_id = ?");
    
    if ($stmt->execute([$contact_id])) {
        header("Location: ../admin.php?message=deleted");
        exit;
    } else {
        echo "Fout bij het verwijderen van het bericht.";
    }
} else {
    header("Location: ../admin.php");
    exit;
}
?>