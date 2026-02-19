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

<h1>Confirmation de commande</h1>

<p>Total à payer : <strong><?= number_format($total, 2) ?> €</strong></p>

<form method="POST" action="actions/validate_order.php">
    <input type="text" name="address" placeholder="Adresse" required><br><br>
    <input type="text" name="city" placeholder="Ville" required><br><br>
    <input type="text" name="postal_code" placeholder="Code postal" required><br><br>
    <button type="submit">Valider la commande</button>
</form>