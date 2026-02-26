<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$user_id = $_SESSION['user']['id'];

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($username)) {
    die("Le pseudo ne peut pas être vide.");
}

/* pseudo existe déjà? */
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
$stmt->bind_param("si", $username, $user_id);
$stmt->execute();
$exists = $stmt->get_result()->num_rows > 0;

if ($exists) {
    die("Ce pseudo est déjà utilisé.");
}

if (!empty($password)) {

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $hashed, $user_id);

} else {

    $stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
    $stmt->bind_param("si", $username, $user_id);
}

$stmt->execute();

$_SESSION['user']['username'] = $username;

header("Location: ../index.php?page=account");
exit;