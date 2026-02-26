<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

require_once "config/db.php";

// Recalculer le total
$user_id = $_SESSION['user']['id'];
$stmt = $conn->prepare("
    SELECT cart.quantity, articles.price
    FROM cart
    JOIN articles ON cart.article_id = articles.id
    WHERE cart.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
while ($row = $result->fetch_assoc()) {
    $total += $row['quantity'] * $row['price'];
}
?>

<div class="page-header">
    <h1 class="page-title">Expédition <span style="color: var(--text-muted)"> //</span></h1>
    <div class="page-subtitle">PROTOCOLE DE LIVRAISON SÉCURISÉ V.4.0</div>
</div>

<main class="container">

    <section class="form-section">
        <form method="POST" action="actions/validate_order.php">
            <div class="form-group">
                <label>Adresse de livraison</label>
                <input
                    type="text"
                    name="address"
                    class="form-control"
                    placeholder="123 Avenue des Dresseurs"
                    required
                >
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Ville</label>
                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        placeholder="Bourg-Palette"
                        required
                    >
                </div>
                <div class="form-group">
                    <label>Code Postal</label>
                    <input
                        type="text"
                        name="postal_code"
                        class="form-control"
                        placeholder="00151"
                        required
                    >
                </div>
            </div>

            <div style="margin-top: auto; padding-top: 32px; border-top: 1px dashed var(--border-tech); font-size: 11px; color: var(--text-muted); letter-spacing: 1px; text-transform: uppercase; line-height: 2;">
                <div>&gt; Vérifiez l'exactitude de votre adresse avant validation</div>
                <div>&gt; Livraison estimée sous 3 à 5 jours ouvrés</div>
                <div>&gt; Un email de confirmation vous sera envoyé</div>
            </div>
        </form>
    </section>

    <aside class="summary-card">
        <div class="summary-title">
            <span>Récapitulatif</span>
            <span class="slashes" style="font-size: 16px;">///</span>
        </div>

        <div class="summary-row">
            <span>Total articles</span>
            <span style="color: var(--accent-cyan);"><?= number_format((float)$total, 2) ?> €</span>
        </div>

        <div class="summary-row">
            <span>Expédition</span>
            <span style="color: var(--accent-cyan);">GRATUIT</span>
        </div>

        <div class="summary-row total">
            <span>Total</span>
            <span style="color: var(--accent-cyan);"><?= number_format((float)$total, 2) ?> €</span>
        </div>

        <!-- bouton qui submit le form à gauche -->
        <button class="submit-btn" type="button" onclick="document.querySelector('.form-section form').submit();">
            Finaliser votre commande
        </button>

        <div class="tech-details">
            <div style="margin-bottom: 8px;">&gt; Transmission cryptée via SSH</div>
            <div style="margin-bottom: 8px;">&gt; Vérification node de livraison</div>
            <div>&gt; Signature numérique requise</div>
        </div>
    </aside>

</main>