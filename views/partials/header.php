<?php
require_once __DIR__ . '/../../config/paths.php';
/*
    HEADER GLOBAL - E-BOUTIQUE MVC
*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lachoperie93</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars(assetUrl('assets/css/style.css')); ?>?v=2">
</head>
<body>

<header>
    <h1>Lachoperie93</h1>
    <p>Boutique premium</p>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php?controller=cart&action=view">Panier</a>

        <?php if (isset($_SESSION['user_id'])): ?>

            <a href="index.php?controller=user&action=profile">Profil</a>

            <?php if ($_SESSION['role'] === 'vendeur'): ?>
                <a href="index.php?controller=product&action=add">Ajouter Produit</a>
            <?php endif; ?>

            <a href="index.php?controller=user&action=logout">Déconnexion</a>

        <?php else: ?>

            <a href="index.php?controller=user&action=login">Connexion</a>
            <a href="index.php?controller=user&action=register">Inscription</a>

        <?php endif; ?>
    </nav>

    <?php if (isset($_SESSION['username'])): ?>
        <p>
            Connecté en tant que :
            <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
        </p>
    <?php endif; ?>
</header>
<div class="search-bar">
    <form action="index.php?controller=product&action=search" method="post" role="search" aria-label="Recherche de produits">
        <div class="search-field">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true" focusable="false">
                <circle cx="10.5" cy="10.5" r="6.5"></circle>
                <path d="m16 16 4.5 4.5" stroke-linecap="round"></path>
            </svg>
            <input
                type="search"
                placeholder="Rechercher un produit"
                aria-label="Rechercher un produit"
                name="search"
                required>
        </div>
        <button type="submit">Rechercher</button>
    </form>
</div>
