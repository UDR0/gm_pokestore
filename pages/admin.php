<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php?page=home");
    exit;
}

require_once "config/db.php";

// Récupérer utilisateurs
$users = $conn->query("SELECT id, username, email, role, balance FROM users");

// Récupérer articles
$articles = $conn->query("SELECT articles.id, articles.name, articles.price, users.username 
                           FROM articles 
                           JOIN users ON articles.author_id = users.id");
?>

<h1>Tableau Administrateur 🛠️</h1>

<h2>Utilisateurs</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Solde</th>
        <th>Actions</th>
    </tr>
    <?php while ($u = $users->fetch_assoc()): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['role']) ?></td>
            <td><?= number_format($u['balance'], 2) ?> €</td>
            <td>
                <?php if ($u['id'] != $_SESSION['user']['id']): ?>
                    <form method="POST" action="actions/admin_delete_user.php" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                <?php else: ?>
                    (Vous)
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<hr>

<h2>Articles</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Vendeur</th>
        <th>Prix</th>
        <th>Actions</th>
    </tr>
    <?php while ($a = $articles->fetch_assoc()): ?>
        <tr>
            <td><?= $a['id'] ?></td>
            <td><?= htmlspecialchars($a['name']) ?></td>
            <td><?= htmlspecialchars($a['username']) ?></td>
            <td><?= number_format($a['price'], 2) ?> €</td>
            <td>
                <form method="POST" action="actions/admin_delete_article.php" style="display:inline;">
                    <input type="hidden" name="article_id" value="<?= $a['id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>