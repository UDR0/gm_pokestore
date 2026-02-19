<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$user_id = $_SESSION['user']['id'];
$address = $_POST['address'] ?? '';
$city = $_POST['city'] ?? '';
$postal_code = $_POST['postal_code'] ?? '';

// Récupérer le panier
$stmt = $conn->prepare("
    SELECT cart.article_id, cart.quantity, articles.price
    FROM cart
    JOIN articles ON cart.article_id = articles.id
    WHERE cart.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$items = [];

while ($row = $result->fetch_assoc()) {
    $total += $row['quantity'] * $row['price'];
    $items[] = $row;
}

if ($total <= 0) {
    die("Panier vide");
}

// Insérer la facture
$stmt = $conn->prepare("INSERT INTO invoice (user_id, total, address, city, postal_code) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("idsss", $user_id, $total, $address, $city, $postal_code);
$stmt->execute();

// Diminuer le stock pour chaque article
foreach ($items as $item) {
    $stmtUpdate = $conn->prepare("UPDATE stock SET quantity = quantity - ? WHERE article_id = ?");
    $stmtUpdate->bind_param("ii", $item['quantity'], $item['article_id']);
    $stmtUpdate->execute();
}

// Vider le panier
$stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

header("Location: ../index.php?page=account");
exit;