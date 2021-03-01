<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
    <meta name="referrer" content="origin-when-cross-origin">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-tap-highlight" content="no">
    <?php if (!defined('MAINTENANCE') && !defined('ERROR_404')) { ?>
    <title>Banque alimentaire de gironde - <?= (ucfirst(str_replace('-', ' ', $segments[1])) ? ucfirst(str_replace('-', ' ', $segments[1])) : 'Accueil') ?></title>
    <?php } else if (defined('MAINTENANCE') && !defined('ERROR_404')) { ?>
    <title>Maintenance</title>
    <?php } else if (!defined('MAINTENANCE') && defined('ERROR_404')) { ?>
    <title>Erreur 404</title>
    <?php } ?>
    <link rel="icon" href="<?= DOMAIN ?>/assets/media/images/logo_head.png">
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/css/style.css">
</head>
<body>
<?php if (!defined('MAINTENANCE') && !defined('ERROR_404') && !defined('ADMIN')) { ?>
<header>
    <div id="burger-container">
        <p>Menu</p>
        <div id="burger">
            <span class="burger-line">Menu</span>
            <span class="burger-line"></span>
            <span class="burger-line"></span>
        </div>
    </div>
    <nav>
        <div class="logo-nav">
            <img src="<?= DOMAIN ?>/assets/media/images/logo.png" alt="logo">
        </div>
        <ul>
            <li class="<?= ($uri == '/') ? 'active' : '' ?>">
                <a href="<?= DOMAIN ?>/">Accueil</a>
            </li>
            <li class="<?= ($uri == '/a-propos') ? 'active' : '' ?>">
                <a href="<?= DOMAIN ?>/a-propos">&Agrave; propos</a>
            </li>
            <li class="<?= ($segments[1] == 'blog') ? 'active' : '' ?>">
                <a href="<?= DOMAIN ?>/blog">Carte</a>
            </li>
            <li class="<?= ($uri == '/contact') ? 'active' : '' ?>">
                <a href="<?= DOMAIN ?>/contact">Contact</a>
            </li>
            <li class="<?= ($uri == '/connexion') ? 'active' : '' ?>">
                <a href="<?= DOMAIN ?>/connexion">Connexion</a>
            </li>
        </ul>
    </nav>
</header>
<?php } ?>
<main>
