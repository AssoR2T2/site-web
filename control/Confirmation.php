<?php
/**
*   Fichier de contrôle pour gérer les confirmations d'actions des utilisateurs
*
*   @author Walid Rémi
*   
*/

$racine = '../'; //chemin racine du projet
$title = "Confirmation"; //Titre de la page

//inclusion du header
include($racine."control/Header.php");


/**
 * Page spécifique passé via GET
 * 
 * @var string|null $page la page peut être 'connexion', 'Inscription', 'signalement', etc
 */
if(isset($_GET['page'])) $page = $_GET['page'];

/**
 * Phrase de confirmation en fonction de la page
 * 
 * @var string $phrase Message à afficher à l'utilisateur pour confirmer l'action.
 */
if($page == "connexion"){
    $phrase = "vous vous êtes bien connecte";
}
else if($page == "Inscription"){
    $phrase = "vous vous êtes bien inscrit";
}
else if($page == "signalement"){
    $phrase = "votre signalemnt a bien été prise en compte";
}
else if($page == "modifUtil" || $page="modife"){
    $phrase = "Votre modification a bien était pris en compte";
}


//inclution la page de confirmation
include($racine."templates/php/Confirmation.php");

//inclusion du footer
include($racine."templates/php/footer.php");

?>