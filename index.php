<?php
session_start();

$page = $_GET['page'] ?? 'home';

$allowed_pages = [
    'home', 'login', 'register', 'detail', 'cart', 'account', 'admin', 'sell', 'confirm', 'favorites'
];

if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

require_once "includes/header.php";
require_once "pages/$page.php";
require_once "includes/footer.php";