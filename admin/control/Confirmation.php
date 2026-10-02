<?php
/**
*   Fichier de contrôle pour gérer les confirmations d'actions des utilisateurs
*
*   @author Walid Rémi
*   
*/

$racine = '../';//chemin racine du projet
$title = "Confirmation";//Titre de la page

//inclusion du header
include($racine."control/Header.php");

require($racine."model/bdd.php");
use bdd\BDD;

require($racine."model/Objet.php");
use bdd\Objet;

require($racine."model/ListeUtilisateur.php");
use bdd\ListeUtilisateur;



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
if($page =="supprimer"){
    $phrase = "Votre Objet a bien était supprimer";

}
else if($page == "connexion"){
    $phrase = "vous vous êtes bien connecte";
}
else if($page == "modife"){
    $phrase = "Votre Objet a bien était modifier";
}
else if($page == "banni"){
    
    $phrase = "la modification du bannissement a bien était prise en compte";
}
else if($page == "supprimeUtil"){
    
     $phrase = "l'utilisateur à bien était supprimer";
}
else if($page == "modifUtil"){
    $phrase = "l'utilisateur a bien était modifier";
}
else if($page == "signalement"){
    $phrase = "votre page a bien était signaler";
}
else if($page == "Inscription"){
    $phrase = "Bienvenue, vous vous ête bien Inscrit";
}

//inclu la page de confirmation
include($racine."templates/php/Confirmation.php");



include($racine."templates/php/footer.php");

?>