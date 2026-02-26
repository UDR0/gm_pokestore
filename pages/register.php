<div class="hero-bg"></div>
<div class="hero-glow"></div>
<div class="hero-scanline"></div>

<main class="registration-wrapper">
    <div class="auth-card">
        <div class="corner tl"></div>
        <div class="corner tr"></div>
        <div class="corner bl"></div>
        <div class="corner br"></div>

        <div class="auth-header">
            <h1>S'inscrire</h1>
            <p>Rejoindre l'élite du trading</p>
        </div>

        <form method="POST" action="actions/register_action.php">
            <div class="form-group">
                <label class="form-label">Identifiant Dresseur</label>
                <input
                    type="text"
                    name="username"
                    class="form-input"
                    placeholder="NOM_UTILISATEUR"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label">Canal de Communication</label>
                <input
                    type="email"
                    name="email"
                    class="form-input"
                    placeholder="EMAIL@GM-POKESTORE.COM"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label">Clé de Sécurité</label>
                <input
                    type="password"
                    name="password"
                    class="form-input"
                    placeholder="••••••••••••"
                    required
                >
            </div>

            <button type="submit" class="submit-btn">Créer un Compte</button>
        </form>

        <div class="auth-footer">
            Déjà membre du réseau ?
            <a href="index.php?page=login">Se connecter</a>
        </div>
    </div>
</main>

<footer style="position: absolute; bottom: 0; width: 100%; padding: 20px; text-align: center; font-size: 10px; color: var(--text-muted); z-index: 10;">
    GM POKÉSTORE // SYSTÈME_VER_4.2.1 // CRYPTAGE_256BIT_ACTIF
</footer>