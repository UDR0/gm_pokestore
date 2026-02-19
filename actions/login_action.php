<?php
session_start();
require_once "../config/db.php";

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($login) || empty($password)) {
    die("Tous les champs sont obligatoires");
}

$stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $login, $login);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

if (!$user || !password_verify($password, $user['password'])) {
    die("Identifiants incorrects");
}

// Stocker en session
$_SESSION['user'] = [
    'id' => $user['id'],
    'username' => $user['username'],
    'email' => $user['email'],
    'role' => $user['role']
];

header("Location: ../index.php?page=home");
exit;