<?php
/**
 *  Fichier de control pour gérer les session et les cookies de l'utilsateur.
*   Représente L'en tête de toute les pages
*
*   @author Walid Rémi
*   
*/

//Démarre la session pour les utilisateur.
session_start(); 

/**
 * Intilitilise les Session si il n'existe pas et génére un token CRSF unique.
 * 
 * @global $_SESSION utilise pour stocker des données de session.
 * 
 * @var bool $_SESSION["connecte"] Indique si l'utilisateur est connecte.
 * @var string $_SESSION["crsf"] génere un token CRSF unique et aléatoire pour sécurisé les requête.
 */
if(!isset($_SESSION["connecte"])) {
    $_SESSION["connecte"] = false;
    $_SESSION['crsf'] = bin2hex(random_bytes(32));
}

/**
 * Vérifie et provoque la déconnection automatique d'un utilisateur inactif si il est connecte.
 * Détruit les informations stocke dans les sessions et les détruits,
 * si le temps d'inactivité est strictement supèrieur au temps donnée
 * 
 * @var int $_SESSION["time"] récupere le temps UNIX a laquel l'utilisateur c'est connecté.
 */
if(isset($_SESSION["connecte"]) && $_SESSION["connecte"] == true){
    if(isset($_SESSION["time"]) && time() - $_SESSION["time"] > 1800){
        session_unset();
        session_destroy();
        $_SESSION["connecte"] = false;
    }
    $_SESSION["time"] = time();
}


/**
 * Vérifie l'existance de Cookie via GET.
 * Vérifie et initialise un cookie si l'utilisateur a accepté ou partiellement accepté,
 * accessible à tous les chemins.
 * Crée une session si l'utilisateur refuse le cookie.
 * 
 * @var bool $_SESSION['cookie'] Indique si l'utilisateur a accepté les coookies.
 * @param string "cookieAccept" nom du Cookies
 * @param string "oui", "ouiP", "non" valeur du Cookies
 * @param int time() + (86400*10) expiration du Cookies, ici il expire au bout de 10 jours.
 * @param string "/" chemin auquel le cookie est accessible
 */
if(isset($_GET['cookieAccept'])){
    if($_GET['cookieAccept'] == "oui"){
        $_SESSION['cookie'] = true;
        setcookie("cookieAccept", "oui", time() + (86400*10), "/");
    }
    else if($_GET['cookieAccept'] == "ouiP"){
        $_SESSION['cookie'] = true;
        setcookie("cookieAccept", "ouiP", time() + (86400*10), "/");
    }
    else if($_GET['cookieAccept'] == "non"){
        $_SESSION['cookie'] = false;
    }
}

//inclusion de l'en-tête
include($racine."templates/php/header.php");

/**
 * Inclusion de la page cookie si aucune action du choix des cookies n'a était faite.
 */
if(!isset($_COOKIE['cookieAccept']) && !isset($_SESSION['cookie'])){
    include($racine."templates/php/PageCookie.php");
}
?>