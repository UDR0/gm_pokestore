<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$cart_id = $_POST['cart_id'] ?? null;
$quantity = $_POST['quantity'] ?? 1;

if ($cart_id && $quantity > 0) {
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $stmt->bind_param("ii", $quantity, $cart_id);
    $stmt->execute();
}

header("Location: ../index.php?page=cart");
exit;