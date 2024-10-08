<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$userId = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();

header("Location: admin.php");
exit();
?>
