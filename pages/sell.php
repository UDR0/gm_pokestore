<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<main class="container">
    <div class="page-title">
        <span class="subtitle">// NOUVEAU LISTING MARKETPLACE</span>
        <h1>Mettre en Vente</h1>
        <div class="slashes">////////////////////////</div>
    </div>

    <div class="sell-layout">

        <!-- FORM -->
        <section class="form-terminal">
            <form method="POST" action="actions/add_article.php">

                <div class="form-group">
                    <label class="form-label">// Identifiant Espèce</label>
                    <div class="input-wrapper">
                        <span class="input-prefix">ID:</span>
                        <input type="text" name="name" class="form-input" placeholder="EX: CHARIZARD" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">// Description de l'Asset</label>
                    <div class="input-wrapper">
                        <textarea name="description" class="form-input" placeholder="DÉTAILS TECHNIQUES, HISTORIQUE..."></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">// Prix de Vente</label>
                    <div class="input-wrapper">
                        <span class="input-prefix">$</span>
                        <input type="number" step="0.01" name="price" class="form-input" placeholder="0.00" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">// Source Visuelle</label>
                    <div class="input-wrapper">
                        <span class="input-prefix">URL://</span>
                        <input type="text" name="image" class="form-input" placeholder="LIEN DE L'IMAGE HAUTE RÉSOLUTION">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">// Quantité disponible</label>
                    <div class="input-wrapper">
                        <span class="input-prefix">UNIT:</span>
                        <input type="number" name="stock" class="form-input" value="1" required>
                    </div>
                </div>

                <button type="submit" class="sell-btn">Confirmer la mise en vente</button>

                <p class="legal-footer">
                    EN CLIQUANT SUR CONFIRMER, VOUS ACCEPTEZ LES FRAIS DE TRANSACTION DE 2.5% ET CERTIFIEZ L'AUTHENTICITÉ DE L'ASSET.
                </p>
            </form>
        </section>

        <!-- PREVIEW -->
        <aside class="preview-section">
            <h3><span class="dot-cyan">●</span> Aperçu du Listing</h3>

            <article class="card">
                <div class="card-spine">
                    <span>GEN_XX // UNKNOWN</span>
                </div>

                <div class="card-content">
                    <div class="card-header">
                        <span class="hashes">###</span>
                    </div>

                    <div class="card-image">
                        <img
                            id="sell-preview-img"
                            src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/0.png"
                            alt="Preview"
                        >
                        <span class="type-badge" id="sell-preview-type">TYPE</span>
                    </div>

                    <div class="card-details">
                        <div>
                            <h2 class="poke-name" id="sell-preview-name">Nom Pokémon</h2>
                            <div class="slashes">///////</div>
                        </div>

                        <div class="stock-row">
                            <div class="stock-dot"></div>
                            <span id="sell-preview-stock">STOCK : --</span>
                        </div>

                        <div class="price-row">
                            <span class="price" id="sell-preview-price">$ --.--</span>
                        </div>
                    </div>
                </div>
            </article>

            <div class="preview-info">
                <span class="accent">SYSTÈME INFO:</span><br>
                L'aperçu se mettra à jour automatiquement lors de la saisie des données. Assurez-vous que l'image est hébergée sur un serveur sécurisé.
            </div>
        </aside>

    </div>
</main>