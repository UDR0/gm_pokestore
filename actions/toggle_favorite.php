<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$user_id = $_SESSION['user']['id'];
$article_id = $_POST['article_id'] ?? null;

if (!$article_id) {
    header("Location: ../index.php?page=home");
    exit;
}

// Vérifier si déjà en favori
$stmt = $conn->prepare("SELECT id FROM favorites WHERE user_id = ? AND article_id = ?");
$stmt->bind_param("ii", $user_id, $article_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Supprimer des favoris
    $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND article_id = ?");
    $stmt->bind_param("ii", $user_id, $article_id);
    $stmt->execute();
} else {
    // Ajouter aux favoris
    $stmt = $conn->prepare("INSERT INTO favorites (user_id, article_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $article_id);
    $stmt->execute();
}

header("Location: ../index.php?page=detail&id=" . $article_id);
exit;