<?php
require_once "config/db.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Article introuvable");
}

// Récupérer l'article
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();

if (!$article) {
    die("Article introuvable");
}

// Récupérer le stock
$stmt = $conn->prepare("SELECT quantity FROM stock WHERE article_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stockRow = $stmt->get_result()->fetch_assoc();
$stock = $stockRow ? $stockRow['quantity'] : 0;

// Vérifier si déjà en favori
$isFav = false;
if (isset($_SESSION['user'])) {
    $stmtFav = $conn->prepare("SELECT id FROM favorites WHERE user_id = ? AND article_id = ?");
    $stmtFav->bind_param("ii", $_SESSION['user']['id'], $article['id']);
    $stmtFav->execute();
    $isFav = $stmtFav->get_result()->num_rows > 0;
}
?>

<h1><?= htmlspecialchars($article['name']) ?></h1>

<?php if (!empty($article['image'])): ?>
    <img src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['name']) ?>" width="150">
<?php endif; ?>

<p><?= htmlspecialchars($article['description']) ?></p>
<p>Prix : <?= number_format($article['price'], 2) ?> €</p>
<p>Stock disponible : <?= $stock ?></p>

<?php if ($stock > 0): ?>
    <?php if (isset($_SESSION['user'])): ?>
        <form method="POST" action="actions/add_to_cart.php">
            <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
            <button type="submit">Ajouter au panier</button>
        </form>
    <?php else: ?>
        <p><a href="index.php?page=login">Connecte-toi</a> pour acheter ce Pokémon ⚡</p>
    <?php endif; ?>
<?php else: ?>
    <p style="color:red;"><strong>Rupture de stock ❌</strong></p>
<?php endif; ?>

<?php if (isset($_SESSION['user'])): ?>
    <form method="POST" action="actions/toggle_favorite.php" style="margin-top:10px;">
        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
        <button type="submit">
            <?= $isFav ? "💔 Retirer des favoris" : "❤️ Ajouter aux favoris" ?>
        </button>
    </form>
<?php endif; ?>