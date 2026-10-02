<!-- header -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="templates/css/body.css">
        <link rel="stylesheet" href="templates/css/header.css">
        <link rel="stylesheet" href="templates/css/footer.css">
        <link rel="stylesheet" href="templates/css/Acceuil.css">
        <link rel="stylesheet" href="templates/css/Contact.css">
        <link rel="stylesheet" href="templates/css/Signalement.css">
        <link rel="stylesheet" href="templates/css/LogSign.css">
        <link rel="stylesheet" href="templates/css/listeObjet.css">
        <link rel="stylesheet" href="templates/css/filtre.css">
        <link rel="stylesheet" href="templates/css/Recherche.css">
        <link rel="stylesheet" href="templates/css/FicheObjet.css">
        <link rel="stylesheet" href="templates/css/PageProfile.css">
    </head>
    
<body class="flexColumn">
    <header>
        <!-- le menu -->
        <nav class="menu-floatant">
            <ul>
                <li><a>Accueil</a></li>
                <li><a>Blog</a></li>
                <li><a>Gallerie</a></li>
                <li><a>Contact</a></li>
                <li><a>Se connecter</a></li>
            </ul>
        </nav>
        <form method="get" id="menu">
            <a href="Accueil" class="buttonMenu">Accueil</a>
            <a href="Recherche" class="buttonMenu">Blog</a>
            <a href="Recherche" class="buttonMenu">Gallerie</a>
            <a href="Contact" class="buttonMenu">Contact</a>
            <?php if($_SESSION["connecte"]) echo "<a class=\"buttonMenu\">Profile</a>" ?>
        </form>

        <!-- menu hamburger -->

        <div id="myHamburger" class="NavMenu">
            <a id="closeNav" class="close">x</a>
            <ul>
                <li><a href="Accueil">Accueil</a></li>
                <li><a href="Recherche">Recherche</a></li>
                <?php if($_SESSION["connecte"]) echo "<li><a href=\"Signalement\">Signalement</a></li>" ?>
                <li><a href="Contact">Contact</a></li>
                <li><a href="Connection">Login</a></li>
                <li><a href="Inscription">SignIn</a></li>
            </ul>
        </div>

        <!-- icon du menu hamburger -->

        <a href="#" id="open" class="burger">
            <span class="burger-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
    </header>