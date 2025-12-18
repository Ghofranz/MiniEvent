    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3><i class="fas fa-calendar-alt"></i> MiniEvent</h3>
                    <p>Plateforme moderne de gestion et réservation d'événements. Découvrez, réservez et participez aux
                        meilleurs événements.</p>
                </div>

                <div class="footer-links">

                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>"><i class="fas fa-home"></i> Accueil</a></li>
                        <li><a href="<?php echo BASE_URL; ?>events"><i class="fas fa-calendar"></i> Événements</a></li>
                        <li><a href="<?php echo BASE_URL; ?>admin/login"><i class="fas fa-user-shield"></i>
                                Administration</a></li>
                    </ul>
                </div>

                <div class="footer-info">

                    <p><i class="fas fa-university"></i> Université de Sousse</p>
                    <p><i class="fas fa-building"></i> ISSAT - Dép. Informatique</p>
                    <p><i class="fas fa-users"></i> ING-GL</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> MiniEvent</p>
            </div>
        </div>
    </footer>


    <script>
const BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <script src="<?php echo BASE_URL; ?>js/script.js"></script>
    </body>

    </html>