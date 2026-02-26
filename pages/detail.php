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

<?php
$articleId = (int)$article['id'];
$pokeId = str_pad((string)$articleId, 3, "0", STR_PAD_LEFT);

$img = trim($article['image'] ?? '');
if ($img === '') {
    $img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$articleId}.png";
}
?>

<main class="product-view">

    <section class="product-visual">
        <div class="visual-grid"></div>
        <div class="pokedex-num">#<?= htmlspecialchars($pokeId) ?></div>
        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($article['name']) ?>" class="main-img">
        <div class="type-corner-badge">GEN_01 // GM_POKESTORE</div>
    </section>

    <section class="product-info">
        <div style="margin-bottom: 10px; font-size: 11px; color: var(--text-muted); letter-spacing: 2px; text-transform: uppercase;">
            DATA_STREAM // SECURE_ENTRY
        </div>

        <h1 class="product-title"><?= htmlspecialchars($article['name']) ?></h1>

        <div class="badges-row">
            <span class="badge badge-grass">GM</span>
            <span class="badge badge-poison">KANTO</span>
        </div>

        <p class="product-desc">
            <?= nl2br(htmlspecialchars($article['description'])) ?>
        </p>

        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-label">ID Article</span>
                <span class="stat-value">#<?= htmlspecialchars($pokeId) ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Stock</span>
                <span class="stat-value"><?= (int)$stock ?></span>
            </div>
        </div>

        <div class="evolution-chain">
            <div class="evo-title">
                Chaîne d'évolution <div class="slashes">///</div>
            </div>
            <div class="evo-row">
                <div class="evo-step">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png" alt="Step 1">
                </div>
                <div class="evo-arrow">→</div>
                <div class="evo-step">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/2.png" alt="Step 2">
                </div>
                <div class="evo-arrow">→</div>
                <div class="evo-step active">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/3.png" alt="Step 3">
                </div>
            </div>
        </div>

        <div class="purchase-section">
            <div class="price-wrap">
                <span class="main-price"><?= number_format((float)$article['price'], 2) ?> €</span>

                <?php if ($stock > 0): ?>
                    <span class="stock-tag">EN STOCK : <?= (int)$stock ?></span>
                <?php else: ?>
                    <span class="stock-tag" style="color: var(--accent-pink);">
                        RUPTURE DE STOCK
                    </span>
                <?php endif; ?>
            </div>

            <div class="actions-row">
                <?php if ($stock > 0): ?>
                    <?php if (isset($_SESSION['user'])): ?>
                        <form method="POST" action="actions/add_to_cart.php" style="flex-grow:1; margin:0;">
                            <input type="hidden" name="article_id" value="<?= $articleId ?>">
                            <button type="submit" class="btn-buy">Ajouter au panier</button>
                        </form>
                    <?php else: ?>
                        <a href="index.php?page=login" class="btn-buy" style="text-decoration:none; display:flex; align-items:center; justify-content:center;">
                            Se connecter pour acheter
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <button class="btn-buy" disabled style="opacity:.4; cursor:not-allowed;">Indisponible</button>
                <?php endif; ?>

                <?php if (isset($_SESSION['user'])): ?>
                    <form method="POST" action="actions/toggle_favorite.php" style="margin:0;">
                        <input type="hidden" name="article_id" value="<?= $articleId ?>">
                        <button type="submit" class="btn-fav<?= $isFav ? ' is-fav' : '' ?>" title="Favori">♥</button>
                    </form>
                <?php else: ?>
                    <a href="index.php?page=login" class="btn-fav" title="Connecte-toi pour ajouter en favori" style="text-decoration:none;">
                        ♥
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </section>
</main>