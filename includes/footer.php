    <?php $page = $_GET['page'] ?? 'home'; ?>
    <?php if ($page !== 'register' && $page !== 'login' && $page !== 'admin'): ?>
    </div>

    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <div class="brand" style="margin-bottom: 24px;">
                    <span>GM</span> PokéStore
                </div>
                <p style="line-height: 1.6; margin-bottom: 24px; opacity: 0.7;">
                    La destination de référence pour le trading Pokémon haut de gamme.
                    Assets numériques et physiques certifiés authentiques.
                    Livraison mondiale disponible.
                </p>
                <div class="slashes">////////////////////////</div>
            </div>

            <div class="footer-col">
                <h4>Plateforme</h4>
                <ul>
                    <li><a href="index.php?page=home">Marché en Direct</a></li>
                    <li><a href="index.php?page=home">Enchères</a></li>
                    <li><a href="index.php?page=account">Mon Coffre</a></li>
                    <li><a href="index.php?page=sell">Vendre</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Assistance</h4>
                <ul>
                    <li><a href="index.php?page=home">Authentification</a></li>
                    <li><a href="index.php?page=home">Politique de Livraison</a></li>
                    <li><a href="index.php?page=home">Conditions d'Utilisation</a></li>
                    <li><a href="index.php?page=home">Nous Contacter</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Newsletter</h4>
                <p class="newsletter-text">Recevez les actus du marché.</p>

                <form class="newsletter-form" action="#" method="post">
                    <input type="email" name="newsletter_email" placeholder="SAISIR VOTRE EMAIL" class="newsletter-input" required>
                    <button type="submit" class="add-cart-btn newsletter-btn">S'ABONNER</button>
                </form>
            </div>
        </div>

        <div style="text-align: center; padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.05); margin-top: 40px;">
            © <?= date('Y') ?> GM POKÉSTORE. TOUS DROITS RÉSERVÉS. SYSTEM_VER_4.2.1
        </div>
    </footer>

</body>
</html>
<?php endif; ?>
</div> <!-- container -->
</body></html>