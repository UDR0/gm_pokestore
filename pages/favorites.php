<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

require_once "config/db.php";

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("
    SELECT articles.* 
    FROM favorites
    JOIN articles ON favorites.article_id = articles.id
    WHERE favorites.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<main style="flex-grow: 1;">
    <section class="page-header">
        <h1 class="page-title">
            Mes Favoris
            <span class="page-counter">
                // [ <?= str_pad((string)$result->num_rows, 2, "0", STR_PAD_LEFT) ?> POKÉMON<?= ($result->num_rows > 1 ? "S" : "") ?> SAUVEGARDÉ<?= ($result->num_rows > 1 ? "S" : "") ?> ]
            </span>
        </h1>
        <div class="slashes" style="margin-top: 12px;">////////////////////////////////////////////////////////////</div>
    </section>

    <div class="favorites-grid">

        <?php if ($result->num_rows === 0): ?>
            <div class="empty-state" style="display:block;">
                <h3>AUCUN FAVORI TROUVÉ</h3>
                <p style="margin-top: 16px; color: var(--text-muted);">VOTRE LISTE DE SURVEILLANCE EST VIDE.</p>
                <a href="index.php?page=home" class="btn-view" style="display: inline-block; margin-top: 24px; padding: 12px 32px;">
                    RETOURNER AU MARCHÉ
                </a>
            </div>
        <?php else: ?>

            <?php while ($article = $result->fetch_assoc()): ?>
                <?php
                $articleId = (int)$article['id'];
                $pokeId = str_pad((string)$articleId, 3, "0", STR_PAD_LEFT);

                $img = trim($article['image'] ?? '');
                if ($img === '') {
                    $img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$articleId}.png";
                }

                $typeText = "FAV";
                $typeClass = "type-psychic";
                ?>
                <article class="fav-card">
                    <div class="fav-card-image">
                        <div class="fav-type-badge <?= $typeClass ?>"><?= $typeText ?></div>
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($article['name']) ?>">
                    </div>

                    <div class="fav-card-info">
                        <div class="fav-id">#<?= htmlspecialchars($pokeId) ?></div>
                        <h2 class="fav-name"><?= htmlspecialchars($article['name']) ?></h2>
                        <div class="fav-footer">
                            <span class="fav-price"><?= number_format((float)$article['price'], 2) ?> €</span>
                        </div>
                    </div>

                    <div class="fav-actions">
                        <a href="index.php?page=detail&id=<?= $articleId ?>" class="btn-view">VOIR DÉTAIL</a>

                        <form method="POST" action="actions/toggle_favorite.php" style="margin:0;">
                            <input type="hidden" name="article_id" value="<?= $articleId ?>">
                            <button type="submit" class="btn-remove" title="Retirer des favoris">❤</button>
                        </form>
                    </div>
                </article>
            <?php endwhile; ?>

        <?php endif; ?>

    </div>
</main>