<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? 0;
$image = $_POST['image'] ?? '';
$stock = $_POST['stock'] ?? 0;

if (empty($name) || $price <= 0 || $stock < 0) {
    die("Champs invalides");
}

// Insert article
$stmt = $conn->prepare("INSERT INTO articles (name, description, price, image, author_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssdsi", $name, $description, $price, $image, $_SESSION['user']['id']);
$stmt->execute();

$article_id = $stmt->insert_id;

// Insert stock
$stmt = $conn->prepare("INSERT INTO stock (article_id, quantity) VALUES (?, ?)");
$stmt->bind_param("ii", $article_id, $stock);
$stmt->execute();

header("Location: ../index.php?page=home");
exit;