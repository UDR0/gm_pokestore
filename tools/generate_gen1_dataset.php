<?php
/**
 * generate_gen1_dataset.php
 *
 * Génère un fichier JSON "pokemon_gen1.json" pour les 151 premiers Pokémon avec :
 * - name
 * - types
 * - description (FR si dispo, sinon EN)
 * - weight (kg) + height (m)
 * - evolutions (ligne d'évolution complète)
 * - price (fictif)
 *
 * Sans images (volontaire).
 */

declare(strict_types=1);

const START_ID = 1;
const END_ID   = 151;

function http_get_json(string $url): array
{
    $ctx = stream_context_create([
        "http" => [
            "method"  => "GET",
            "header"  => "User-Agent: GM-PokeStore-Dataset/1.0\r\n",
            "timeout" => 20
        ]
    ]);

    $raw = @file_get_contents($url, false, $ctx);
    if ($raw === false) {
        throw new RuntimeException("Erreur HTTP sur: $url");
    }

    $data = json_decode($raw, true);
    if (!is_array($data)) {
        throw new RuntimeException("JSON invalide sur: $url");
    }

    return $data;
}

function normalize_flavor_text(string $t): string
{
    // Nettoie les retours chelous présents dans certains flavor_text
    $t = str_replace(["\n", "\r", "\f"], " ", $t);
    $t = preg_replace('/\s+/', ' ', $t);
    return trim((string)$t);
}

function pick_description(array $species): string
{
    $entries = $species["flavor_text_entries"] ?? [];
    if (!is_array($entries) || !$entries) {
        return "";
    }

    // Priorité FR, puis EN
    $fr = null;
    $en = null;

    foreach ($entries as $e) {
        $lang = $e["language"]["name"] ?? "";
        $txt  = $e["flavor_text"] ?? "";
        if (!is_string($txt) || $txt === "") continue;

        if ($lang === "fr" && $fr === null) $fr = $txt;
        if ($lang === "en" && $en === null) $en = $txt;

        if ($fr !== null && $en !== null) break;
    }

    $chosen = $fr ?? $en ?? "";
    return normalize_flavor_text($chosen);
}

function extract_evolution_lines(array $evoChain): array
{
    // Transforme la structure "chain" en "lignes" (ex: ["bulbasaur","ivysaur","venusaur"])
    $lines = [];

    $walk = function (array $node, array $path) use (&$walk, &$lines) {
        $name = $node["species"]["name"] ?? null;
        if (is_string($name) && $name !== "") {
            $path[] = $name;
        }

        $next = $node["evolves_to"] ?? [];
        if (!is_array($next) || count($next) === 0) {
            // Fin de branche => une ligne complète
            if (count($path) > 0) $lines[] = $path;
            return;
        }

        foreach ($next as $child) {
            if (is_array($child)) {
                $walk($child, $path);
            }
        }
    };

    $root = $evoChain["chain"] ?? null;
    if (!is_array($root)) return [];

    $walk($root, []);
    return $lines;
}

function find_line_for_species(string $speciesName, array $allLines): array
{
    foreach ($allLines as $line) {
        if (in_array($speciesName, $line, true)) {
            return $line;
        }
    }
    return [];
}

function fake_price(int $id, array $types): int
{
    // Prix fictif stable, et légèrement influencé par le type principal
    $base = 60 + (($id * 9) % 241); // 60..300

    $t1 = $types[0] ?? "";
    $bonus = match ($t1) {
        "dragon"  => 120,
        "psychic" => 60,
        "fire"    => 40,
        "electric"=> 35,
        "water"   => 25,
        "ghost"   => 50,
        default   => 0,
    };

    return $base + $bonus;
}

$out = [];
$errors = [];

for ($id = START_ID; $id <= END_ID; $id++) {
    try {
        // 1) Données de base
        $pokemon = http_get_json("https://pokeapi.co/api/v2/pokemon/$id");

        $name = (string)($pokemon["name"] ?? "pokemon-$id");

        // Types
        $types = [];
        foreach (($pokemon["types"] ?? []) as $t) {
            $types[] = $t["type"]["name"] ?? null;
        }
        $types = array_values(array_filter($types, fn($x) => is_string($x) && $x !== ""));

        // Taille/poids
        // height = décimètres -> m, weight = hectogrammes -> kg
        $height_m = ((int)($pokemon["height"] ?? 0)) / 10.0;
        $weight_kg = ((int)($pokemon["weight"] ?? 0)) / 10.0;

        // 2) Species (description + lien vers evolution chain)
        $speciesUrl = $pokemon["species"]["url"] ?? null;
        if (!is_string($speciesUrl) || $speciesUrl === "") {
            throw new RuntimeException("species.url manquant pour $name");
        }
        $species = http_get_json($speciesUrl);

        $description = pick_description($species);

        // 3) Evolution chain (ligne d'évolution)
        $evoUrl = $species["evolution_chain"]["url"] ?? null;
        $evolution_line = [];
        if (is_string($evoUrl) && $evoUrl !== "") {
            $evoChain = http_get_json($evoUrl);
            $allLines = extract_evolution_lines($evoChain);
            $speciesName = (string)($species["name"] ?? $name);
            $evolution_line = find_line_for_species($speciesName, $allLines);
        }

        // 4) Prix fictif
        $price = fake_price($id, $types);

        $out[] = [
            "pokedex_id" => $id,
            "name" => $name,
            "types" => $types,                // ex: ["grass","poison"]
            "description" => $description,    // FR si dispo sinon EN
            "weight_kg" => $weight_kg,
            "height_m" => $height_m,
            "evolutions" => $evolution_line,  // ex: ["bulbasaur","ivysaur","venusaur"]
            "price_eur" => $price,
        ];

        // Petite pause pour éviter de taper l’API comme un bourrin
        usleep(120000); // 120ms
    } catch (Throwable $e) {
        $errors[] = ["id" => $id, "error" => $e->getMessage()];
    }
}

file_put_contents(__DIR__ . "/pokemon_gen1.json", json_encode($out, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
file_put_contents(__DIR__ . "/pokemon_gen1_errors.json", json_encode($errors, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

echo "✅ Terminé.\n";
echo "- pokemon_gen1.json (".count($out)." entrées)\n";
echo "- pokemon_gen1_errors.json (".count($errors)." erreurs)\n";
