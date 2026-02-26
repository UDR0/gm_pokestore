<div class="hero-bg"></div>
<div class="hero-glow"></div>

<main class="login-wrapper">
    <div class="login-card">
        <div class="corner tl"></div>
        <div class="corner br"></div>

        <h1 class="login-title">Connexion</h1>
        <div class="login-subtitle">ACCÈS AU RÉSEAU SÉCURISÉ</div>

        <form method="POST" action="actions/login_action.php">
            <div class="form-group">
                <div class="label-row">
                    <label for="login">Identifiant</label>
                </div>
                <div class="input-wrapper">
                    <input
                        type="text"
                        id="login"
                        name="login"
                        placeholder="NOM_UTILISATEUR"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="password">Clé d'accès</label>
                    <a href="index.php?page=login" class="forgot-pass">Oublié ?</a>
                </div>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••••••"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn-submit">Se Connecter</button>
        </form>

        <div class="login-footer">
            NOUVEL UTILISATEUR ? <a href="index.php?page=register">CRÉER UN COMPTE</a>
        </div>
    </div>
</main>

<div style="position: absolute; bottom: 20px; width: 100%; text-align: center; color: var(--text-muted); font-size: 10px; z-index: 10;">
    SYSTEM_VER_4.2.1 // ENCRYPTED_CONNECTION_ESTABLISHED
</div>