<?php
/**
*   Gérer, Controle et affiche seulement les objet de l'utilisateur connecté.
*
*   @author Walid Rémi
*   
*/
$racine="../";//racine du projet
$title = "Vos Objets";//titre de la page

require($racine."model/bdd.php");
use bdd\BDD;
/**
 * inclusion du fichier Objet.php situé dans model
 * 
 * le fichier Objet contient les implémentations nécessaire pour gérer
 * les Objet. Il est requis pour assurer le bon fonctionnement
 * du contrôle et des interactions avec les Objets.
 * 
 * @require Objet.php Fichier contenant les définitions du model Objet.
 */
require($racine."model/Objet.php");
use bdd\Objet;
//inclusion de l'en-tête de page
include($racine."control/Header.php");

echo "<main id=\"pageRecherche\" class=\"flexColumn\"><nav>";
/**
 * Liste seulement les objets de l'utilisateur pour lui permettre de voire et modifie ces Objets
 * depuis la base de donnée.
 * 
 * @var Objet $Objet Contient les methode de la class Objet
 * @var int $idObjet Contient l'id de l'Objet
 * @var string $NomObjet1 Contient le nom de l'objet avec espace
 * @var string $NomObjet Contient le nom de l'objet sans espace
 * @var string $date Contient le date de l'objet
 * @var string $lieu Contient le lieu de l'objet
 * @var string $description Contient la description de l'objet
 * @var string $etat Contient l'etat de l'objet
 * @var int $idUtilisateur Contient l'id de l'utilisateur
 * @var string $auteur Contient le nom et prenom de l'utilisateur
 * @var string $image Contient le lien vers l'image dans le serveur. Si il n'y pas d'image renvoie vers une autre image
 * 
 */

$Objet = new Objet();

foreach($Objet->listeObjet() as $X){
    if($X[4] == $_SESSION["id"]){
        $idObjet = $X[0];
        $NomObjet1 = $X[1];
        $date = $X[2];
        $lieu = $X[3];
        $idUtilisateur = $X[4];
        $Etat = $X[5];
        $auteur = $X[6]." ".$X[7];
        if($X[8] != "") $image = "/~uapv2402240/image/objet/".$X[8];
        else $image = "/~uapv2402240/image/noImage.png";

        $NomObjet = str_replace(" ", "_", $NomObjet1);
        //inclusion du formulaire de modification de l'objet
        include($racine."templates/php/ModifObjet.php");
    }
}

echo "</nav></main>";
//inclusion du pied page
include($racine."templates/php/footer.php");
?>