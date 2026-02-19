<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../index.php?page=home");
    exit;
}

$article_id = $_POST['article_id'] ?? null;

if ($article_id) {
    // Supprimer du panier
    $stmt = $conn->prepare("DELETE FROM cart WHERE article_id = ?");
    $stmt->bind_param("i", $article_id);
    $stmt->execute();

    // Supprimer le stock
    $stmt = $conn->prepare("DELETE FROM stock WHERE article_id = ?");
    $stmt->bind_param("i", $article_id);
    $stmt->execute();

    // Supprimer l'article
    $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
}

header("Location: ../index.php?page=admin");
exit;