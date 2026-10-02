<!-- header -->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/body.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/header.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/footer.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/Acceuil.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/FAQ.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/Signalement.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/LogSign.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/listeObjet.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/filtre.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/Recherche.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/FicheObjet.css">
        <link rel="stylesheet" href="/~uapv2402240/admin/templates/css/PageProfile.css">
    </head>
    
<body class="flexColumn">
    <header>
        <div id="barre1">
            <img id="logo" src="/~uapv2402240/image/logo.png"/>
            <div>
                <h1>TrackMyStuff</h1>
                <h3 >attention vous êtes connecte en tant qu'ADMINISTRATEUR</h3>
            </div>
            <form id="connexion">
                <?php 
                if($_SESSION["connecte"] == true){
                    echo "<a  href=\"MonProfil-administrateur\"><img id=\"profile\" src=\"/~uapv2402240/image/profile.PNG\"> </a>";
                }
                else{
                    echo " <a href=\"Connection-administrateur\" class=\"buttonMenu\" id=\"login\">Login</a>
                    <div id=\"barreSepar\">/</div>
                    <a href=\"Inscription-administrateur\" class=\"buttonMenu\" id=\"signIn\">SignIn</a>";
                }
            ?>
            </form>
        </div>

        <!-- le menu -->
        <form method="get" id="menu">
            <?php 
            if($_SESSION["connecte"] == true){
            echo "<a href=\"Accueil-administrateur\" class=\"buttonMenu\">Accueil</a>
            <a href=\"Recherche-administrateur\" class=\"buttonMenu\">Recherche</button>
            <a href=\"Signalement-administrateur\" class=\"buttonMenu\">Signalement</a>
            <a href=\"Liste-Utilisateur-administrateur\" class=\"buttonMenu\">Liste des Utilisateurs</a>
            <a href=\"FAQ-administrateur\" class=\"buttonMenu\">F.A.Q</a>";
            }
            ?>
        </form>
        
        <!-- menu hamburger -->

        <div id="myHamburger" class="NavMenu">
            <a id="closeNav" class="close">x</a>
            <ul>
                <?php 
                if($_SESSION["connecte"] == true){
                    echo "
                    <li><a href=\"Accueil-administrateur\">Accueil</a></li>
                    <li><a href=\"Recherche-administrateur\">Recherche</a></li>
                    <li><a href=\"Signalement-administrateur\">Signalement</a></li>
                    <li><a href=\"Liste-Utilisateur-administrateur\" class=\"buttonMenu\">Liste des Utilisateurs</a></li>
                    <li><a href=\"FAQ-administrateur\">F.A.Q</a></li>";
                }
                ?>
                <li><a href="Connection-administrateur">Login</a></li>
                <li><a href="Inscription-administrateur">SignIn</a></li>
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