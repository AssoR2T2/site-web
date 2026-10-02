<?php
/**
*   Gère et Control les informations des Objet pour l'affichage des liste d'objet
*
*   @author Walid Rémi
*   
*/
    $racine = '../';//racine du projet
    $title = "Recherche";//Titre de la page

    
    //inclusion de l'en-tête de page
    include($racine."control/Header.php");
    require($racine."model/bdd.php");
    use bdd\BDD;
      /**
     * inclusion du fichier Objet.php situé dans model
     * 
     * le fichier Utilisateur contient les implémentations nécessaire pour gérer
     * les Utilisateur en fonction des objets. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les Utilisateur en fonction des objets.
     * 
     * @require Objet.php Fichier contenant les définitions du model Objet.
     */
    require($racine."class/Utilisateur.php");
    use Control\Utilisateur;
    /**
     * inclusion du fichier Objet.php situé dans model
     * 
     * Le fichier Objet contient les implémentations nécessaire pour gérer
     * les Objet. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les Objets.
     * 
     * @require Objet.php Fichier contenant les définitions du model Objet.
     */
    require($racine."model/Objet.php");
    use bdd\Objet;

            /**
         * Permet de supprimer l'objet du site et surtout de la base de donnée.
         * 
         * @var Objet $suppObjet Permet d'utiliser les fonction de la classe objet pour supprimer des éléments du site et de la base de donnée.
         * @var int $idObjet Correspond à l'id de l'objet qui vas être supprimer.
         * @var string $phrase Permet de renvoyer si il y a eu une erreur de suppréssion.
         
         * 
         */
    if(isset($_GET['idobjetSupp'])){
        try{
            $idobjet = $_GET['idobjetSupp'];
            $suppObjet = new Objet();
            $suppObjet->removeObject($idobjet);
            
            header("Location: Confirmation-supprimer-administrateur");
            exit;
        }
        catch(Exception $e){
            $phrase = "erreur votre Objet n'a pas était supprimer";
        }
    }

    //récupération de certain information dans la bdd grace aux l'id
    
    echo "<main id=\"pageRecherche\" class=\"flexColumn\">";
        //inclu une page de fitlrage
        include($racine."templates/html/filtrage.html");

        /**
         * Récupère et affiche chaque Objet présente dans la base de donnée 
         * 
         * @var Objet $Objet Contient les methode de la class Objet
         * @var array $Objet->listeObjet() Contient une liste de tous les objet de la base de donnée
         * @var int $idObjet Correspond à l'id de l'objet
         * @var string $NomObjet Contient le nom de l'objet
         * @var string $date Contient le date de l'objet
         * @var string $lieu Contient le lieu de l'objet
         * @var int $idUtilisateur Correspond à l'id de l'utilisateur qui a signaler l'objet
         * @var string $Etat Contient l'etat de l'objet
         * @var string $auteur Contient le nom et prenom de l'utilisateur
         * @var string $image Contient le lien vers l'image dans le serveur. Si il n'y pas d'image renvoie vers une autre image
         */
        echo "<nav>";  
        $Objet = new Objet();
        foreach($Objet->listeObjet() as $X){
            $idObjet = $X[0];
            $NomObjet = $X[1];
            $date = $X[2];
            $lieu = $X[3];
            $idUtilisateur = $X[4];
            $Etat = $X[5];
            $auteur = $X[6]." ".$X[7];
            if($X[8] != "") $image = "/~uapv2402240/image/objet/".$X[8];
            else $image = "/~uapv2402240/image/noImage.png";

            include($racine."templates/php/listeObjet.php");
        }
        echo "</nav>";
    
    echo"</main>";

    
//inclusion du pied page
    include($racine."templates/php/footer.php");
?>