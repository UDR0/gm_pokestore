<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page = $_GET['page'] ?? 'home';
$isAuthPage = ($page === 'login' || $page === 'register');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GM PokéStore</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS global -->
    <link rel="stylesheet" href="assets/css/front.css">

    <!-- CSS par page -->
    <?php if ($page === 'home'): ?>
        <link rel="stylesheet" href="assets/css/home.css">
    <?php endif; ?>

    <?php if ($page === 'register'): ?>
        <link rel="stylesheet" href="assets/css/register.css">
    <?php endif; ?>

    <?php if ($page === 'login'): ?>
        <link rel="stylesheet" href="assets/css/login.css">
    <?php endif; ?>

    <?php if ($page === 'cart'): ?>
        <link rel="stylesheet" href="assets/css/cart.css">
    <?php endif; ?>

    <?php if ($page === 'confirm'): ?>
        <link rel="stylesheet" href="assets/css/confirm.css">
    <?php endif; ?>

    <?php if ($page === 'detail'): ?>
        <link rel="stylesheet" href="assets/css/detail.css">
    <?php endif; ?>
    
    <?php if ($page === 'favorites'): ?>
        <link rel="stylesheet" href="assets/css/favorites.css">
    <?php endif; ?>

    <?php if ($page === 'account'): ?>
        <link rel="stylesheet" href="assets/css/account.css">
    <?php endif; ?>

    <?php if (isset($_GET['page']) && $_GET['page'] === 'admin'): ?>
        <link rel="stylesheet" href="assets/css/admin.css">
    <?php endif; ?>
</head>

<body>

<header>
    <div class="brand">
        <span>GM</span> PokéStore <div class="slashes">//////</div>
    </div>

    <?php if ($isAuthPage): ?>
        <?php
            $rightText = ($page === 'register') ? 'REGISTRATION_REQUIRED' : 'AUTHENTICATION_REQUIRED';
        ?>
        <div style="font-size: 11px; color: var(--text-muted); letter-spacing: 1.5px; font-family: var(--font-tech); display: flex; align-items: center; gap: 8px;">
            <a href="index.php?page=home"
               style="color: var(--accent-cyan); text-decoration: none; transition: color 0.2s;"
               onmouseover="this.style.color='#fff'"
               onmouseout="this.style.color='var(--accent-cyan)'">
               ACCUEIL
            </a>
            <span style="color: var(--border-tech);">//</span>
            <?= $rightText ?>
        </div>
    <?php else: ?>
        <nav>
            <ul>
                <li><a href="index.php?page=home" class="<?= ($page === 'home') ? 'active' : '' ?>">Accueil</a></li>

                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="index.php?page=cart" class="<?= ($page === 'cart') ? 'active' : '' ?>">Panier</a></li>
                    <li><a href="index.php?page=favorites" class="<?= ($page === 'favorites') ? 'active' : '' ?>">Favoris</a></li>
                    <li><a href="index.php?page=account" class="<?= ($page === 'account') ? 'active' : '' ?>">Compte</a></li>

                    <?php if (!empty($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <li><a href="index.php?page=admin" class="<?= ($page === 'admin') ? 'active' : '' ?>">Admin</a></li>
                    <?php endif; ?>

                    <li><a href="actions/logout.php" style="color: var(--accent-pink);">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=login" class="<?= ($page === 'login') ? 'active' : '' ?>">Connexion</a></li>
                    <li><a href="index.php?page=register" class="<?= ($page === 'register') ? 'active' : '' ?>">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</header>