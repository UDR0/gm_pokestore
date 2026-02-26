<?php
require_once "config/db.php";

// Récupérer le terme de recherche
$search = $_GET['search'] ?? '';

// Préparer la requête
if (!empty($search)) {
    $stmt = $conn->prepare("
        SELECT articles.*, users.username
        FROM articles
        LEFT JOIN users ON articles.author_id = users.id
        WHERE articles.name LIKE ?
        ORDER BY articles.created_at DESC
    ");
    $like = "%" . $search . "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("
        SELECT articles.*, users.username
        FROM articles
        LEFT JOIN users ON articles.author_id = users.id
        ORDER BY articles.created_at DESC
    ");
}
?>

<section class="hero-landing">
    <div class="hero-bg"></div>
    <div class="hero-glow"></div>
    <div class="hero-scanline"></div>

    <div class="hero-inner">

        <div class="hero-copy">
            <div class="hero-eyebrow">GM PokéStore // Plateforme Premium</div>

            <h2 class="hero-headline">
                Catch<br>
                <span class="line-muted">Legends.</span><br>
                <span class="line-accent">Own</span> <span class="line-glow">Power.</span>
            </h2>

            <p class="hero-sub">
                La <em>référence absolue</em> du trading Pokémon d'élite.
                Assets authentifiés. Données de marché en temps réel.
                <em>Sans compromis.</em>
            </p>

            <div class="hero-cta-row">
                <a href="#market" class="hero-cta-primary" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;">
                    Accéder au Marché
                </a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat-item">
                    <span class="hero-stat-num">151</span>
                    <span class="hero-stat-label">Espèces listées</span>
                </div>
                <div class="hero-stat-item">
                    <span class="hero-stat-num">12K</span>
                    <span class="hero-stat-label">Dresseurs actifs</span>
                </div>
                <div class="hero-stat-item">
                    <span class="hero-stat-num">$4.2M</span>
                    <span class="hero-stat-label">Volume / Mois</span>
                </div>
            </div>
        </div>

        <div class="hero-card-wrap">
            <div class="hero-poke-card">
                <div class="corner-accent tl"></div>
                <div class="corner-accent tr"></div>
                <div class="corner-accent bl"></div>
                <div class="corner-accent br"></div>

                <div class="hero-card-top">
                    <span class="hero-card-tag">// Offre du Jour</span>
                    <span class="hero-card-id">150</span>
                </div>

                <div class="hero-card-img-wrap">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png" alt="Mewtwo">
                    <div class="hero-card-type-badge">PSYCHIC</div>
                </div>

                <div class="hero-card-info">
                    <div class="hero-card-name">Mewtwo</div>
                    <div class="hero-card-meta">
                        <span class="hero-card-rarity">DERNIER EXEMPLAIRE — AGIS VITE</span>
                        <span class="hero-card-price">$2,400</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="container" id="market">

    <section class="hero-search">
        <div class="hero-grid-lines"></div>

        <h1 style="font-family: var(--font-display); font-size: 64px; margin-bottom: 24px; text-transform: uppercase; line-height: 0.9;">
            Région <span style="color: var(--text-muted)">Kanto</span><br>
            <span style="color: var(--accent-purple)">Base de Données</span>
        </h1>

        <!-- searchbar -->
        <form class="search-interface" method="GET" action="index.php">
            <input type="hidden" name="page" value="home">
            <input
                type="text"
                class="search-input"
                name="search"
                placeholder="RECHERCHER ESPÈCE / ID / TYPE..."
                value="<?= htmlspecialchars($search) ?>"
            >
            <button class="search-btn" type="submit">Scanner</button>
        </form>

        <div class="filter-bar">
            <div class="filter-tag">TYPE : FEU</div>
            <div class="filter-tag">TYPE : EAU</div>
            <div class="filter-tag">TYPE : PLANTE</div>
            <div class="filter-tag">STATUT : RARE</div>
            <div class="filter-tag">RÉGION : KANTO</div>
        </div>
    </section>

    <div class="catalog" id="catalog">

        <?php if ($result->num_rows === 0): ?>
            <div style="padding: 30px; opacity: 0.8;">
                Aucun Pokémon trouvé 😢
            </div>
        <?php else: ?>

            <?php
            // Prépare une requête stock
            $stockStmt = $conn->prepare("SELECT quantity FROM stock WHERE article_id = ?");

            $i = 0;
            $totalCards = $result->num_rows;
            ?>

            <?php while ($article = $result->fetch_assoc()): ?>
                <?php
                $articleId = (int)$article['id'];
                $pokeId = str_pad((string)$articleId, 3, "0", STR_PAD_LEFT);

                // Stock
                $stockQty = null;
                if ($stockStmt) {
                    $stockStmt->bind_param("i", $articleId);
                    $stockStmt->execute();
                    $stockRow = $stockStmt->get_result()->fetch_assoc();
                    $stockQty = $stockRow['quantity'] ?? null;
                }

                // Image
                $img = trim($article['image'] ?? '');

                if ($img === '') {
                    $pokeId = (int)$article['id']; // doit correspondre au Pokédex ID
                    $img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$pokeId}.png";
                }

                $seller = $article['username'] ?? "GM Poke'Store";

                // Voir plus: cache tout après 12
                $hidden = ($i >= 12);
                ?>

                <article class="card js-card" style="<?= $hidden ? 'display:none;' : '' ?>">
                    <div class="tech-border-top"></div>

                    <div class="card-spine">
                        <span><?= strtoupper("GM_STORE // " . $seller) ?></span>
                    </div>

                    <div class="card-content">
                        <div class="card-header">
                            <span class="poke-id"><?= htmlspecialchars($pokeId) ?></span>

                            <!-- FAVORI (toggle) -->
                            <form method="POST" action="actions/toggle_favorite.php" style="margin:0;">
                                <input type="hidden" name="article_id" value="<?= $articleId ?>">
                                <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                                <button type="submit" class="favorite-btn">♥</button>
                            </form>
                        </div>

                        <div class="card-image">
                            <a href="index.php?page=detail&id=<?= $articleId ?>" style="display:block;">
                                <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($article['name']) ?>">
                            </a>
                            <div class="card-overlay"></div>
                            <div class="type-badge">GM POKÉSTORE</div>
                        </div>

                        <div class="card-details">
                            <div>
                                <a href="index.php?page=detail&id=<?= $articleId ?>" class="poke-name" style="text-decoration:none;color:inherit;display:inline-block;">
                                    <?= htmlspecialchars($article['name']) ?>
                                </a>
                                <div class="slashes">///////</div>
                            </div>

                            <?php if ($stockQty !== null): ?>
                                <?php if ((int)$stockQty <= 1): ?>
                                    <div class="stock-status" style="color: var(--accent-pink);">DERNIER EXEMPLAIRE</div>
                                <?php else: ?>
                                    <div class="stock-status">EN STOCK : <?= str_pad((string)$stockQty, 2, "0", STR_PAD_LEFT) ?></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="stock-status">EN STOCK : --</div>
                            <?php endif; ?>

                            <div class="price-row">
                                <span class="price"><?= number_format((float)$article['price'], 2) ?> €</span>

                                <!-- AJOUT PANIER -->
                                <form method="POST" action="actions/add_to_cart.php" style="margin:0;">
                                    <input type="hidden" name="article_id" value="<?= $articleId ?>">
                                    <button type="submit" class="add-cart-btn">AJOUTER +</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </article>

                <?php $i++; ?>
            <?php endwhile; ?>

            <?php if ($stockStmt) { $stockStmt->close(); } ?>

            <?php if ($totalCards > 12): ?>
                    <div style="display:flex; justify-content:center; margin: 40px 0;">
                        <div style="display:flex; gap: 14px; align-items:center;">
                            <button id="btnVoirMoins"
                                    type="button"
                                    class="search-btn"
                                    style="width:auto; padding: 14px 28px; opacity: 0.35; cursor: not-allowed;"
                                    disabled>
                                Voir moins
                            </button>

                            <button id="btnVoirPlus"
                                    type="button"
                                    class="search-btn"
                                    style="width:auto; padding: 14px 28px;">
                                Voir plus
                            </button>
                        </div>
                    </div>

                    <script>
                        (function () {
                            const batch = 12;
                            const cards = Array.from(document.querySelectorAll(".js-card"));
                            const btnPlus = document.getElementById("btnVoirPlus");
                            const btnMoins = document.getElementById("btnVoirMoins");
                            const catalog = document.getElementById("catalog");

                            if (!btnPlus || !btnMoins) return;

                            function visibleCount() {
                                return cards.filter(c => c.style.display !== "none").length;
                            }

                            function setMoinsEnabled(enabled) {
                                btnMoins.disabled = !enabled;
                                btnMoins.style.opacity = enabled ? "1" : "0.35";
                                btnMoins.style.cursor = enabled ? "pointer" : "not-allowed";
                            }

                            function updateButtons() {
                                const shown = visibleCount();
                                setMoinsEnabled(shown > 12);
                                btnPlus.style.display = (shown >= cards.length) ? "none" : "";
                            }

                            // Init
                            updateButtons();

                            btnPlus.addEventListener("click", () => {
                                const hidden = cards.filter(c => c.style.display === "none");
                                hidden.slice(0, batch).forEach(c => c.style.display = "");
                                updateButtons();
                            });

                            btnMoins.addEventListener("click", () => {
                                // Revenir à 12 visibles
                                cards.forEach((c, idx) => {
                                    c.style.display = (idx < 12) ? "" : "none";
                                });

                                updateButtons();

                                // Scroll propre vers la grille
                                if (catalog) {
                                    catalog.scrollIntoView({ behavior: "smooth", block: "start" });
                                }
                            });
                        })();
                    </script>
                <?php endif; ?>

        <?php endif; ?>

    </div>
</div>