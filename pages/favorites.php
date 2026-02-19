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

<h1>❤️ Mes Favoris</h1>

<?php if ($result->num_rows === 0): ?>
    <p>Tu n’as aucun favori pour le moment.</p>
<?php else: ?>
    <?php while ($article = $result->fetch_assoc()): ?>
        <div style="border:1px solid #ccc; padding:10px; margin:10px;">
            <h3><?= htmlspecialchars($article['name']) ?></h3>
            <p><?= number_format($article['price'], 2) ?> €</p>
            <a href="index.php?page=detail&id=<?= $article['id'] ?>">Voir détail</a>
        </div>
    <?php endwhile; ?>
<?php endif; ?>