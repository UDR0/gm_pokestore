<?php
declare(strict_types=1);

// Import GM Poke'Store : articles + stock depuis pokemon_gen1.json
$dsn = "mysql:host=localhost;dbname=gm_pokestore_db;charset=utf8mb4";
$user = "root";
$pass = ""; // XAMPP par défaut

$jsonPath = __DIR__ . "/pokemon_gen1.json";
if (!file_exists($jsonPath)) {
    die("❌ pokemon_gen1.json introuvable dans /tools");
}

$data = json_decode(file_get_contents($jsonPath), true);
if (!is_array($data)) {
    die("❌ JSON invalide");
}

$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// Anti-doublons si relance : on considère "name" unique pour le seed
$exists = $pdo->prepare("SELECT id FROM articles WHERE name = :name LIMIT 1");

$insertArticle = $pdo->prepare("
    INSERT INTO articles (author_id, name, description, price, image)
    VALUES (NULL, :name, :description, :price, NULL)
");

$insertStock = $pdo->prepare("
    INSERT INTO stock (article_id, quantity)
    VALUES (:article_id, :quantity)
");

$pdo->beginTransaction();

$imported = 0;
$skipped = 0;

foreach ($data as $p) {
    $name = (string)($p["name"] ?? "");
    if ($name === "") { $skipped++; continue; }

    $exists->execute([":name" => $name]);
    if ($exists->fetchColumn()) { $skipped++; continue; }

    // On met une description "jeu" + votre punchline plus tard si vous voulez
    $desc = (string)($p["description"] ?? "");
    if ($desc === "") $desc = "Pokémon de compagnie. ⚠️ À surveiller à la maison.";

    $price = (float)($p["price_eur"] ?? 99);
    $qty   = (int)($p["stock_qty"] ?? 10);

    // Optionnel : tu peux enrichir la description avec types/taille/poids/évolutions
    $types = isset($p["types"]) && is_array($p["types"]) ? implode(", ", $p["types"]) : "";
    $height = isset($p["height_m"]) ? (string)$p["height_m"] : "";
    $weight = isset($p["weight_kg"]) ? (string)$p["weight_kg"] : "";
    $evo = isset($p["evolutions"]) && is_array($p["evolutions"]) ? implode(" -> ", $p["evolutions"]) : "";

    $extras = [];
    if ($types !== "")  $extras[] = "Types: $types";
    if ($height !== "") $extras[] = "Taille: {$height}m";
    if ($weight !== "") $extras[] = "Poids: {$weight}kg";
    if ($evo !== "")    $extras[] = "Évolutions: $evo";

    if ($extras) {
        $desc .= "\n\n" . implode(" | ", $extras);
    }

    $insertArticle->execute([
        ":name" => $name,
        ":description" => $desc,
        ":price" => $price,
    ]);

    $articleId = (int)$pdo->lastInsertId();

    $insertStock->execute([
        ":article_id" => $articleId,
        ":quantity" => $qty,
    ]);

    $imported++;
}

$pdo->commit();

echo "✅ Import fini<br>";
echo "Importés: <b>$imported</b><br>";
echo "Ignorés (déjà présents / invalides): <b>$skipped</b><br>";
