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

<h1>GM Poke'Store 🐾⚡</h1>

<form method="GET" action="index.php" style="margin-bottom:20px;">
    <input type="hidden" name="page" value="home">
    <input type="text" name="search" placeholder="Rechercher un Pokémon..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Rechercher</button>
</form>

<?php if ($result->num_rows === 0): ?>
    <p>Aucun Pokémon trouvé 😢</p>
<?php endif; ?>

<?php while ($article = $result->fetch_assoc()): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h3><?= htmlspecialchars($article['name']) ?></h3>
        <p>Vendu par <?= htmlspecialchars($article['username'] ?? "GM Poke'Store") ?></p>
        <p><?= number_format($article['price'], 2) ?> €</p>
        <a href="index.php?page=detail&id=<?= $article['id'] ?>">Voir détail</a>
    </div>
<?php endwhile; ?>