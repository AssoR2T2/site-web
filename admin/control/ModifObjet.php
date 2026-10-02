<?php

/**
*   Gere et control la modification de l'objet.
*
*   @author Walid Rémi
*   
*/
$racine = "../";//racine du projet
$title = "Modification d'Objet";//titre de la page

//inclusion de l'en-tête.
include($racine."control/Header.php");

/**
 * inclusion du fichier bdd.php situé dans le dossier model
 * 
 * le fichier bdd contient les implémentations nécessaire pour gérer
 * la base de donnée. Il est requis pour assurer le bon fonctionnement
 * du contrôle et des interactions avec la base de donnée.
 * 
 * @require bdd.php Fichier contenant les définition du model bdd
 */
require($racine."model/bdd.php");
use bdd\BDD;


/**
 * Inclusion du fichier Objet.php situé dans le dossier modèle.
 *
 * Ce fichier contient les définitions et implémentations nécessaires pour
 * gérer les objets dans le projet. Il est requis pour assurer le bon fonctionnement
 * du contrôle et des interactions avec les données des objets.
 *
 * @require Objet.php Fichier contenant les définitions du model Objet.
 */
require($racine."model/Objet.php");
use bdd\Objet;

/**
 * Vérifie l'excitence de l'ID et le nom de l'objet à modifier et les récupère via GET
 * 
 * @var int $id Correspond a l'id de l'objet
 * @var string $nom1 Correspond au nom de l'objet avec espace
 * @var string $nom Correspond au nom de l'objet sans espace
 */
if(isset($_GET['idObjet']) && isset($_GET['nomObjet'])){
    $id = $_GET['idObjet'];
    $nom1 = $_GET['nomObjet'];
    $nom = str_replace("_", " ", $nom1);
}
/**
 * Vérifie et récupère les informations, saisie par l'utilisateur, de l'objet via POST
 * Vérifie également la correspondance du token CRSF pour plus de sécurité.
 * 
 * @var string $nomObjet Correspond au nom de l'objet
 * @var string $etat Correspond à l'etat de l'objet, soit sur perdu soit sur trouver.
 * @var string $date Correspond à la date de l'objet
 * @var string $lieu Correspond au lieu de l'objet
 * @var string $description Correspond a la description de l'objet
 * @var Objet $ModifObjet crée une instance d'objet, pour utilise ses methodes 
 * 
 * @param int $id Correspond à l'id de l'objet
 * @param string $nomObjet Correspond au nom de l'objet
 * @param string $etat Correspond à l'etat de l'objet, soit sur perdu soit sur trouver.
 * @param string $date Correspond à la date de l'objet
 * @param string $lieu Correspond au lieu de l'objet
 * @param string $description Correspond a la description de l'objet
 */

if(isset($_POST['nomObjet']) && isset($_POST['etat']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['description'])){
    $nomObjet = $_POST['nomObjet'];
    $etat = $_POST['etat'];
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];
    $description = $_POST['description'];

    //modifie l'objet l'objet grace a la fonction de la class
    $ModifObjet = new Objet();
    $ModifObjet->modifieObject($id, $date, $lieu, $etat, $description, $nomObjet);

    //renvoye vers la page de confirmation
    header("Location: Confirmation-modife-administrateur");
    exit;
}
//inclusion du formulaire de modification de l'objet
include($racine."templates/php/ModifObjetPerso.php");



//inclusion du pieds de page
include($racine."templates/php/footer.php");

?>