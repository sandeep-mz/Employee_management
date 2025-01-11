<?php
require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare delete query
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: ../views/index.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
