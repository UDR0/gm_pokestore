<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$amount = $_POST['amount'] ?? 0;
$user_id = $_SESSION['user']['id'];

if ($amount > 0) {
    $stmt = $conn->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
    $stmt->bind_param("di", $amount, $user_id);
    $stmt->execute();
}

header("Location: ../index.php?page=account");
exit;