<?php
session_start();
require_once "../config/db.php";

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($email) || empty($password)) {
    die("Tous les champs sont obligatoires");
}

// Vérifier si username ou email existe déjà
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Nom d'utilisateur ou email déjà utilisé");
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insérer l'utilisateur
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashedPassword);
$stmt->execute();

$user_id = $stmt->insert_id;

// Connecter automatiquement l'utilisateur
$_SESSION['user'] = [
    'id' => $user_id,
    'username' => $username,
    'email' => $email,
    'role' => 'user'
];

header("Location: ../index.php?page=home");
exit;