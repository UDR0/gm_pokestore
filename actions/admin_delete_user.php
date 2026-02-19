<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../index.php?page=home");
    exit;
}

$user_id = $_POST['user_id'] ?? null;

if ($user_id) {
    // Supprimer son panier
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Supprimer ses articles
    $stmt = $conn->prepare("DELETE FROM articles WHERE author_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Supprimer l'utilisateur
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

header("Location: ../index.php?page=admin");
exit;