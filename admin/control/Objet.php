<?php
/**
*   Gère et control les infromations d'un objet
*
*   @author Walid Rémi
*   
*/
    $racine = '../';//racine du projet
        /**
     * inclusion du fichier Objet.php situé dans model
     * 
     * le fichier Objet contient les implémentations nécessaire pour gérer
     * les Objet. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les Objets.
     * 
     * @require Objet.php Fichier contenant les définitions du model Objet.
     */
    require($racine."model/bdd.php");
    use bdd\BDD;

    /**
     * inclusion du fichier Utilisateur.php situé dans le dossier class
     * inclusion du fichier Objet.php situé dans le dossier model
     * 
     * le fichier Utilisateur contient les implémentations nécessaire pour gérer
     * l'utilisateur. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec l'utilisateur.
     * le fichier Objet contient les implémentations nécessaire pour gérer
     * l'Objet. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec l'Objet.
     * 
     * @require Utilisateur.php Fichier contenant les définition de la class Utilisateur
     * @require Objet.php Fichier contenant les définition du model Objet
     */
    require($racine."class/Utilisateur.php");
    use Control\Utilisateur;
    
    require($racine."model/Objet.php");
    use bdd\Objet;

    

    /**
     * Récupération des informations de l'objet grace a l'id envoie via GET depuis Recherche.php
     * 
     * @var int $id Correspond à l'id de l'objet
     * @var Objet $ModifObjet crée une instance d'objet du model, pour utilise ses methodes
     * @var array $ArrayObjet Tableau associatif contenant une instance de la class Objet 
     * et une instance de la class Utilisateur
     * @var Objet $getObjet Contient les methode de la class Objet
     * @var Utilisateur $getUtilisateur Contient les methode de la class Utilisateur
     * 
     * @var string $NomObjet Contient le nom de l'objet grace à $getObjet->getnom
     * @var string $date Contient le date de l'objet grace à $getObjet->getdate
     * @var string $lieu Contient le lieu de l'objet grace à $getObjet->getlieu
     * @var string $description Contient la description de l'objet grace à $getObjet->getdescrip
     * @var string $Etat Contient l'etat de l'objet grace à $getObjet->getetat
     * @var string $auteur Contient le nom et prenom de l'utilisateur grace à $getUtilisateur->getnom() et $getUtilisateur->getprenom()
     * @var array $photo Tableau Contenant les chemin d'access des photos grace à $getObjet->getphoto
     */
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $Objet = new Objet();
        $ArrayObjet = $Objet->getObjet($id);
        $getObjet = $ArrayObjet[0];
        $getUtilisateur = $ArrayObjet[1];

        
        $idutilisateur = $getUtilisateur->getid();
        $NomObjet = $getObjet->getnom();
        $date = $getObjet->getdate();
        $lieu = $getObjet->getlieu();
        $description = $getObjet->getdescrip();
        $Etat = $getObjet->getetat();
        $auteur = $getUtilisateur->getnom()." ".$getUtilisateur->getprenom();
        $photo = $getObjet->getphoto();
        if($photo['linkphoto1'] != NULL) {
            foreach($photo as $T){
                if($T != NULL)$image[] = "/~uapv2402240/image/objet/".$T;
            }
        }
        else $image[] = "/~uapv2402240/image/noImage.png";
    }

    $title = $NomObjet;//titre de la page

    $NomObjet1 = str_replace(" ", "_", $NomObjet);
    //inclusion de l'en-tête de page
    include($racine."control/Header.php");

    //inclusion de la fiche de l'objet
    include($racine."templates/php/ficheObjet.php");
  //inclusion du pied de page
    include($racine."templates/php/footer.php");
?>