<?php
require_once "config/db.php";

$user_id = $_SESSION['user']['id'];

// Récupérer le panier
$stmt = $conn->prepare("
    SELECT cart.id as cart_id, cart.quantity, articles.name, articles.price, articles.id as article_id
    FROM cart
    JOIN articles ON cart.article_id = articles.id
    WHERE cart.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<div class="cart-page-header">
    <h1 class="cart-title">Votre Panier <span style="color: var(--text-muted)"> //</span></h1>
    <div class="cart-subtitle">LOG_ID: BSK-9921 / SYSTÈME DE TRANSACTION SÉCURISÉ</div>
</div>

<main class="cart-container">

    <section class="cart-items">
        <?php if ($result->num_rows === 0): ?>
            <div style="background: var(--bg-panel); padding: 28px; color: var(--text-muted);">
                Ton panier est vide 😢
            </div>
        <?php else: ?>

            <?php
            $itemsCount = 0;
            ?>

            <?php while ($item = $result->fetch_assoc()):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
                $itemsCount += (int)$item['quantity'];

                // Récupérer le stock pour cet article
                $stmtStock = $conn->prepare("SELECT quantity FROM stock WHERE article_id = ?");
                $stmtStock->bind_param("i", $item['article_id']);
                $stmtStock->execute();
                $stockRow = $stmtStock->get_result()->fetch_assoc();
                $maxStock = $stockRow ? $stockRow['quantity'] : 1;

                $articleId = (int)$item['article_id'];
                $pokeId = str_pad((string)$articleId, 3, "0", STR_PAD_LEFT);
                $img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$articleId}.png";
            ?>
                <article class="cart-item">
                    <div class="item-img-box">
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    </div>

                    <div class="item-info">
                        <div class="item-id">#<?= htmlspecialchars($pokeId) ?> // GM</div>
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <div class="slashes">////</div>
                    </div>

                    <div class="item-qty">
                        <form method="POST" action="actions/update_cart.php" style="display:flex; align-items:center; gap:12px; margin:0;">
                            <input type="hidden" name="cart_id" value="<?= (int)$item['cart_id'] ?>">

                            <button class="qty-btn" type="button" onclick="this.nextElementSibling.stepDown(); this.closest('form').submit();">-</button>

                            <input
                                type="number"
                                name="quantity"
                                value="<?= (int)$item['quantity'] ?>"
                                min="1"
                                max="<?= (int)$maxStock ?>"
                                style="width:64px; text-align:center; background: rgba(255,255,255,0.03); border: 1px solid var(--border-tech); color: var(--text-main); padding: 8px 10px; font-family: var(--font-tech); outline:none;"
                            >

                            <button class="qty-btn" type="button" onclick="this.previousElementSibling.stepUp(); this.closest('form').submit();">+</button>
                        </form>
                    </div>

                    <div class="item-price"><?= number_format((float)$subtotal, 2) ?> €</div>

                    <form method="POST" action="actions/remove_from_cart.php" style="margin:0;">
                        <input type="hidden" name="cart_id" value="<?= (int)$item['cart_id'] ?>">
                        <button type="submit" class="remove-btn" title="Supprimer">✕</button>
                    </form>
                </article>
            <?php endwhile; ?>

        <?php endif; ?>
    </section>

    <aside class="cart-summary">
        <div class="summary-title">
            <span>Total Commande</span>
            <span class="slashes" style="font-size: 16px;">///</span>
        </div>

        <?php if ($result->num_rows === 0): ?>
            <div class="summary-row" style="color: var(--text-muted); font-size: 12px;">
                <span>Articles</span>
                <span>0 unité</span>
            </div>
            <div class="summary-row total">
                <span>Sous-total</span>
                <span style="color: var(--accent-cyan);">0.00 €</span>
            </div>

            <button class="checkout-btn" disabled style="opacity:.4; cursor:not-allowed;">Valider la commande</button>
        <?php else: ?>
            <div class="summary-row" style="color: var(--text-muted); font-size: 12px;">
                <span>Articles</span>
                <span><?= (int)$itemsCount ?> unité<?= ((int)$itemsCount > 1 ? 's' : '') ?></span>
            </div>

            <div class="summary-row total">
                <span>Sous-total</span>
                <span style="color: var(--accent-cyan);"><?= number_format((float)$total, 2) ?> €</span>
            </div>

            <a href="index.php?page=confirm" style="text-decoration:none; display:block;">
                <button class="checkout-btn" type="button">Valider la commande</button>
            </a>
        <?php endif; ?>

        <div class="tech-details">
            <div style="margin-bottom: 8px;">&gt; Chiffrement AES-256 actif</div>
            <div style="margin-bottom: 8px;">&gt; Livraison via Poké-Transporter</div>
            <div>&gt; Garantie d'authenticité certifiée</div>
        </div>
    </aside>

</main>