<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<h1>Mettre un Pokémon en vente</h1>

<form method="POST" action="actions/add_article.php">
    <input type="text" name="name" placeholder="Nom du Pokémon" required><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>
    <input type="number" step="0.01" name="price" placeholder="Prix" required><br><br>
    <input type="text" name="image" placeholder="Lien de l'image"><br><br>
    <input type="number" name="stock" placeholder="Stock initial" required><br><br>
    <button type="submit">Mettre en vente</button>
</form>