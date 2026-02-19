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

<h1>Mon Compte 👤</h1>

<h2>Mes informations</h2>
<p><strong>Username :</strong> <?= htmlspecialchars($user['username']) ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
<p><strong>Solde :</strong> <?= number_format($user['balance'], 2) ?> €</p>

<h3>Ajouter de l'argent</h3>
<form method="POST" action="actions/add_balance.php">
    <input type="number" step="0.01" name="amount" placeholder="Montant" required>
    <button type="submit">Ajouter</button>
</form>

<hr>

<h2>Mes articles en vente</h2>
<?php if ($myArticles->num_rows === 0): ?>
    <p>Tu n'as encore rien mis en vente.</p>
<?php else: ?>
    <ul>
        <?php while ($a = $myArticles->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($a['name']) ?> - <?= number_format($a['price'], 2) ?> €
                | <a href="index.php?page=detail&id=<?= $a['id'] ?>">Voir</a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>

<hr>

<h2>Mes factures</h2>
<?php if ($invoices->num_rows === 0): ?>
    <p>Aucune commande pour le moment.</p>
<?php else: ?>
    <ul>
        <?php while ($inv = $invoices->fetch_assoc()): ?>
            <li>
                Commande du <?= $inv['created_at'] ?> - <?= number_format($inv['total'], 2) ?> €
            </li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>

<hr>

<h2>Modifier mes informations</h2>

<form method="POST" action="actions/update_account.php">
    <input type="email" name="email" placeholder="Nouvel email" required><br><br>
    <input type="password" name="password" placeholder="Nouveau mot de passe (laisser vide pour ne pas changer)"><br><br>
    <button type="submit">Mettre à jour</button>
</form>