<?php
/**
    *   Gère, Control et Affiche une liste d'utilisateur,
    *   Cela permet de bannir, débannir, modif ou supprime les l'utilisateurs
    *
    *   @author Walid Rémi
    */
$racine = "../";//racine du projet
$title="Liste d'utilisateur";//titre de la page


//inclusion de l'en-tête de page
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
 * inclusion du fichier ListeUtilisateur.php situé dans le dossier model
 * 
 * le fichier ListeUtilisateur contient les implémentations nécessaire pour gérer
 * les utilisateur. Il est requis pour assurer le bon fonctionnement
 * du contrôle et des interactions avec une liste d'utilisateur.
 * 
 * @require ListeUtilisateur.php Fichier contenant les définition du model ListeUtilisateur
 */
require($racine."model/ListeUtilisateur.php");
use bdd\ListeUtilisateur;

/**
 * Permet la récupération d'une liste d'utilisateur depuis la base de donnée.
 * en fonction de l'action de l'administrateur, permet de supprime, bannir débannie ou modifie l'utilisateur
 * grace la page et l'id via GET
 * 
 * @var ListeUtilisateur $ClassUtili $banniUtil $suppUtil Contient les methode du model ListeUtilisateur
 * @var array $ClassUtili->ListeUtil Contient une liste de tout les utilisateur sous forme de tableau
 * @var string $page Contient l'action réalise par l'administrateur via GET
 */
$ClassUtili = new ListeUtilisateur();
$ListeUtilisateur = $ClassUtili->ListeUtil();

if(isset($_GET['id']) && isset($_GET['page'])){
    $page = $_GET['page'];
    if($page == "banni"){
        $banniUtil = new ListeUtilisateur();
        $banniUtil->Unban($_GET['id']);

        header("Location: Confirmation-$page-administrateur");
        exit;
    }
    else if($page == "supprimeUtil"){
        $suppUtil = new ListeUtilisateur();
        $suppUtil->removeUtil($_GET['id']);

        header("Location: Confirmation-$page-administrateur");
        exit;
    }
}

echo "<main id=\"pageRecherche\" class=\"flexColumn\" >";

//inclusion d'un tableau contenant tout les utilisateurs
include($racine."templates/php/ListeUtilisateur.php");

echo"</main>";

//inclusion du pied de page
include($racine."templates/php/footer.php");

?>