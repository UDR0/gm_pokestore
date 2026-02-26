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

<div class="alert-banner">
    ACCES_LEVEL : ROOT // MODE ADMINISTRATEUR ACTIF // SESSION ID: <?= htmlspecialchars(session_id()) ?>
</div>

<main class="admin-grid">

    <!-- USERS -->
    <section class="admin-section">
        <div class="section-header">
            <h2 class="section-title">Gestion Utilisateurs</h2>
            <div class="section-stats">
                TOTAL_RECORDS: <span><?= (int)$users->num_rows ?></span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Rôle</th>
                    <th>Solde</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($u = $users->fetch_assoc()): ?>
                <tr>
                    <td>#<?= (int)$u['id'] ?></td>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td>
                        <?php if ($u['role'] === 'admin'): ?>
                            <span class="badge badge-admin">ADMIN</span>
                        <?php else: ?>
                            <span class="badge badge-user">USER</span>
                        <?php endif; ?>
                    </td>
                    <td class="price-cyan"><?= number_format((float)$u['balance'], 2) ?> €</td>
                    <td>
                        <?php if ($u['id'] != $_SESSION['user']['id']): ?>
                            <form method="POST" action="actions/admin_delete_user.php" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?= (int)$u['id'] ?>">
                                <button type="submit" class="btn-delete">SUPPR.</button>
                            </form>
                        <?php else: ?>
                            <button class="btn-delete" disabled>SUPPR.</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <!-- ARTICLES -->
    <section class="admin-section">
        <div class="section-header">
            <h2 class="section-title">Gestion Marketplace</h2>
            <div class="section-stats">
                ACTIVE_LISTINGS: <span><?= (int)$articles->num_rows ?></span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Pokémon</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Vendeur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($a = $articles->fetch_assoc()): ?>
                <tr>
                    <td style="display:flex;align-items:center;gap:10px;">
                        <div class="poke-thumb" style="display:flex;align-items:center;justify-content:center;font-size:10px;color:var(--text-muted);">
                            #
                        </div>
                        <?= htmlspecialchars($a['name']) ?>
                    </td>

                    <td><span class="badge badge-type" style="color: var(--text-muted);">N/A</span></td>

                    <td class="price-cyan"><?= number_format((float)$a['price'], 2) ?> €</td>
                    <td><?= htmlspecialchars($a['username']) ?></td>
                    <td>
                        <form method="POST" action="actions/admin_delete_article.php" style="display:inline;">
                            <input type="hidden" name="article_id" value="<?= (int)$a['id'] ?>">
                            <button type="submit" class="btn-delete">SUPPR.</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </section>

</main>

<footer class="admin-min-footer">
    GM_POKESTORE // INTERNAL_ADMIN_CONSOLE_v4.2 // COPYRIGHT © 2023
</footer>

</body>
</html>