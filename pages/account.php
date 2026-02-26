<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

require_once "config/db.php";

$user_id = $_SESSION['user']['id'];

// Récupérer infos user
$stmt = $conn->prepare("SELECT username, email, balance FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Récupérer articles publiés
$stmt = $conn->prepare("SELECT * FROM articles WHERE author_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$myArticles = $stmt->get_result();

// Récupérer factures
$stmt = $conn->prepare("SELECT * FROM invoice WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$invoices = $stmt->get_result();
?>

<?php
$username = $user['username'] ?? '';
$email = $user['email'] ?? '';
$balance = (float)($user['balance'] ?? 0);

$initials = '';
if ($username !== '') {
    $parts = preg_split('/[^a-zA-Z0-9]+/', $username);
    $parts = array_values(array_filter($parts));
    if (count($parts) >= 2) {
        $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
    } else {
        $initials = strtoupper(substr($username, 0, 2));
    }
}
if ($initials === '') $initials = 'GM';
?>

<main class="container">
    <div class="account-grid">

        <aside>
            <section class="tech-block">
                <div class="block-title">Mes Informations <span class="slashes">////</span></div>

                <div class="user-profile">
                    <div class="avatar"><?= htmlspecialchars($initials) ?></div>
                    <div class="user-info-text">
                        <span class="username"><?= htmlspecialchars($username) ?></span>
                        <span class="email"><?= htmlspecialchars($email) ?></span>
                    </div>
                </div>

                <div class="balance-display">
                    <div class="balance-label">Solde disponible</div>
                    <div class="balance-amount"><?= number_format($balance, 2) ?> €</div>
                </div>
            </section>

            <section class="tech-block">
                <div class="block-title">Créditer le compte <span class="slashes">////</span></div>

                <form method="POST" action="actions/add_balance.php">
                    <div class="form-group">
                        <label class="form-label">Montant (€)</label>
                        <input type="number" step="0.01" name="amount" class="tech-input" placeholder="0.00" required>
                    </div>
                    <button class="tech-btn" type="submit">Créditer</button>
                </form>
            </section>

            <section class="tech-block">
                <div class="block-title">Sécurité <span class="slashes">////</span></div>

                <form method="POST" action="actions/update_account.php">
                    <div class="form-group">
                        <label class="form-label">Nouveau Pseudo</label>
                        <input type="text"
                            name="username"
                            class="tech-input"
                            value="<?= htmlspecialchars($username) ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nouveau Mot de passe</label>
                        <input type="password"
                            name="password"
                            class="tech-input"
                            placeholder="••••••••">
                    </div>

                    <button class="tech-btn secondary" type="submit">
                        Mettre à jour
                    </button>
                </form>
            </section>
        </aside>

        <div>
            <section class="tech-block">
                <div class="block-title">Mes Articles en Vente <span class="slashes">//////</span></div>

                <?php if ($myArticles->num_rows === 0): ?>
                    <div style="color: var(--text-muted); font-size: 13px;">
                        Tu n'as encore rien mis en vente.
                    </div>
                <?php else: ?>
                    <div class="inventory-list">
                        <?php while ($a = $myArticles->fetch_assoc()): ?>
                            <?php
                            $articleId = (int)$a['id'];
                            $img = trim($a['image'] ?? '');
                            if ($img === '') {
                                $img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$articleId}.png";
                            }
                            ?>
                            <article class="mini-card">
                                <div class="mini-card-img">
                                    <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($a['name']) ?>">
                                </div>
                                <div class="mini-card-body">
                                    <div>
                                        <h3 class="mini-card-name"><?= htmlspecialchars($a['name']) ?></h3>
                                        <span class="mini-card-price"><?= number_format((float)$a['price'], 2) ?> €</span>
                                    </div>

                                    <a
                                        href="index.php?page=detail&id=<?= $articleId ?>"
                                        class="withdraw-btn"
                                        style="text-decoration:none; display:inline-block;"
                                    >
                                        Voir
                                    </a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </section>

            <section class="tech-block">
                <div class="block-title">Historique des Factures <span class="slashes">//////</span></div>

                <?php if ($invoices->num_rows === 0): ?>
                    <div style="color: var(--text-muted); font-size: 13px;">
                        Aucune commande pour le moment.
                    </div>
                <?php else: ?>
                    <div class="logs-container">
                        <?php while ($inv = $invoices->fetch_assoc()): ?>
                            <div class="log-entry">
                                <div>
                                    <span class="log-date"><?= htmlspecialchars($inv['created_at']) ?></span>
                                    <span>CMD — </span>
                                    <span class="log-amount"><?= number_format((float)$inv['total'], 2) ?> €</span>
                                </div>

                                <span class="status-badge status-delivered">Archivé</span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>

    </div>
</main>