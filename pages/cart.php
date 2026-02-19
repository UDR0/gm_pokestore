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

<h1>Mon Panier 🛒</h1>

<?php if ($result->num_rows === 0): ?>
    <p>Ton panier est vide 😢</p>
<?php else: ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Article</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Sous-total</th>
            <th>Actions</th>
        </tr>

        <?php while ($item = $result->fetch_assoc()): 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            // Récupérer le stock pour cet article
            $stmtStock = $conn->prepare("SELECT quantity FROM stock WHERE article_id = ?");
            $stmtStock->bind_param("i", $item['article_id']);
            $stmtStock->execute();
            $stockRow = $stmtStock->get_result()->fetch_assoc();
            $maxStock = $stockRow ? $stockRow['quantity'] : 1;
        ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= number_format($item['price'], 2) ?> €</td>
            <td>
                <form method="POST" action="actions/update_cart.php" style="display:inline;">
                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="<?= $maxStock ?>">
                    <button type="submit">Mettre à jour</button>
                </form>
            </td>
            <td><?= number_format($subtotal, 2) ?> €</td>
            <td>
                <form method="POST" action="actions/remove_from_cart.php" style="display:inline;">
                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Total : <?= number_format($total, 2) ?> €</h3>

    <a href="index.php?page=confirm">
        <button>Commander</button>
    </a>
<?php endif; ?>