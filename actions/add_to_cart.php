<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$article_id = $_POST['article_id'] ?? null;
$user_id = $_SESSION['user']['id'];

if (!$article_id) {
    die("Article invalide");
}

// Vérifier le stock
$stmt = $conn->prepare("SELECT quantity FROM stock WHERE article_id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$stockRow = $stmt->get_result()->fetch_assoc();

if (!$stockRow || $stockRow['quantity'] <= 0) {
    die("❌ Article en rupture de stock");
}

// Vérifier si déjà dans le panier
$stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND article_id = ?");
$stmt->bind_param("ii", $user_id, $article_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Vérifier qu'on ne dépasse pas le stock
    if ($row['quantity'] + 1 > $stockRow['quantity']) {
        die("❌ Stock insuffisant pour en ajouter plus");
    }

    $newQty = $row['quantity'] + 1;
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $stmt->bind_param("ii", $newQty, $row['id']);
    $stmt->execute();
} else {
    // Ajouter au panier
    $stmt = $conn->prepare("INSERT INTO cart (user_id, article_id, quantity) VALUES (?, ?, 1)");
    $stmt->bind_param("ii", $user_id, $article_id);
    $stmt->execute();
}

header("Location: ../index.php?page=cart");
exit;