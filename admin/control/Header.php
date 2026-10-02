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
 * Vérifie et provoque la déconnection automatique d'un utilisateur inactif si il est connecte.
 * Détruit les informations stocke dans les sessions et les détruits,
 * si le temps d'inactivité est strictement supèrieur au temps donnée
 * 
 * @var int $_SESSION["time"] récupere le temps UNIX a laquel l'utilisateur c'est connecté.
 */
if(!isset($_SESSION["connecte"])) $_SESSION["connecte"] = false;


if(isset($_SESSION["connecte"]) && $_SESSION["connecte"] == true){
    if(isset($_SESSION["time"]) && time() - $_SESSION["time"] > 1800){
        session_unset();
        session_destroy();
        $_SESSION["connecte"] = false;
    }
    $_SESSION["time"] = time();
}
/**
 * Vérifie que l'administrateur n'est pas connecte, si tel est le cas le renvoye vers la page de connection
 * 
 */

else if(isset($_SESSION["connecte"]) && $_SESSION["connecte"] == false && $_SERVER['REQUEST_URI'] != "/~uapv2402240/Connection-administrateur"){
    header("Location: Connection-administrateur");
    exit;
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
        setcookie("cookieAccept", "oui", time() + (60*10), "/");
    }
    else if($_GET['cookieAccept'] == "ouiP"){
        $_SESSION['cookie'] = true;
        setcookie("cookieAccept", "ouiP", time() + (60*10), "/");
    }
    else if($_GET['cookieAccept'] == "non"){
        $_SESSION['cookie'] = false;
    }
}

//inclusion du header
include($racine."templates/php/header.php");
/**
 * Inclusion de la page cookie si aucune action du choix des cookies n'a était faite.
 */
if(!isset($_COOKIE['cookieAccept']) && !isset($_SESSION['cookie'])){
    include($racine."templates/php/PageCookie.php");
}


?>