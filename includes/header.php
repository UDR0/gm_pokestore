<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GM Poke'Store</title>
</head>
<body>
<nav>
    <a href="index.php?page=home">Home</a>

    <?php if (isset($_SESSION['user'])): ?>
        <a href="index.php?page=cart">Panier</a>
        <a href="index.php?page=favorites">❤️ Favoris</a>
        <a href="index.php?page=account">Compte</a>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="index.php?page=admin">Admin</a>
        <?php endif; ?>
        <a href="actions/logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="index.php?page=login">Connexion</a>
        <a href="index.php?page=register">Inscription</a>
    <?php endif; ?>
</nav>
<hr>        