<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$cart_id = $_POST['cart_id'] ?? null;

if ($cart_id) {
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
}

header("Location: ../index.php?page=cart");
exit;