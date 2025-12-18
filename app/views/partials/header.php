<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MiniEvent - Application de gestion de réservations d'événements">
    <title><?php echo $title ?? SITE_NAME; ?></title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    < <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">


        <link rel="icon" type="image/svg+xml"
            href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📅</text></svg>">
</head>

<body>

    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="<?php echo BASE_URL; ?>" class="logo">
                <i class="fas fa-calendar-alt"></i>
                <span>MiniEvent</span>
            </a>

            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-menu" id="navMenu">
                <li>
                    <a href="<?php echo BASE_URL; ?>"
                        class="<?php echo ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == BASE_URL) ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                </li>

                <?php if (isset($_SESSION['admin_logged_in'])): ?>
                <li>
                    <a href="<?php echo BASE_URL; ?>admin/dashboard"
                        class="<?php echo strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>admin/logout" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo BASE_URL; ?>admin/login"
                        class="<?php echo strpos($_SERVER['REQUEST_URI'], 'login') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-user-shield"></i>
                        <span>Admin</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
    <div class="container">
        <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span><?php echo htmlspecialchars($_SESSION['success']); ?></span>
        </div>
        <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($_SESSION['error']); ?></span>
        </div>
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main>