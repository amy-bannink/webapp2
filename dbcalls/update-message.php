<?php
include('conn.php'); 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_id'])) {
    $contact_id = (int)$_POST['contact_id'];
    $stmt = $conn->prepare("UPDATE contact SET status = 'read' WHERE contact_id = ?");
    if ($stmt->execute([$contact_id])) {
        header("Location: ../admin.php");
        exit;
    } else {
        echo "Fout bij het updaten van de status.";
    }
} else {
    header("Location: ../admin.php");
    exit;
}
?>
