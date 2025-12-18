<section class="login-section">
    <div class="login-card">
        <!-- Login Header -->
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h1>Espace Admin</h1>
            <p>Connectez-vous pour accéder au tableau de bord</p>
        </div>


        <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="" id="loginForm">
            <div class="form-group">
                <label for="username">
                    <i class="fas fa-user"></i> Nom d'utilisateur
                </label>
                <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required
                    autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i> Mot de passe
                </label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe"
                        required autocomplete="current-password">
                    <button type="button" onclick="togglePassword()"
                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray-400);">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg">
                <i class="fas fa-sign-in-alt"></i>
                <span>Se connecter</span>
            </button>
        </form>

        <div class="login-footer">
            <a href="<?php echo BASE_URL; ?>">
                <i class="fas fa-arrow-left"></i> Retour au site
            </a>
        </div>


    </div>
</section>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>