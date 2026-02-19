<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$user_id = $_SESSION['user']['id'];

if (!empty($email)) {
    $stmt = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();
    $_SESSION['user']['email'] = $email;
}

if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hashed, $user_id);
    $stmt->execute();
}

header("Location: ../index.php?page=account");
exit;