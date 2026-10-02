<?php
/**
*   Gère et control les actions de l'utilisateur dans son profile
*
*   @author Walid Rémi
*   
*/
    $racine='../';//racine du projet
    $title = "Profile";//titre de la page

    //inclusion de l'en-tête de page
    include($racine."control/Header.php");

    /**
     * inclusion du fichier bdd.php situé dans le dossier model
     * inclusion du fichier Connexion.php situé dans le dossier model
     * 
     * le fichier bdd contient les implémentations nécessaire pour gérer
     * la base de donnée. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec la base de donnée.
     * 
     * le fichier Connexion contient les définitions et implémentations nécessaires pour
     * gérer les connexion de l'utilisateur. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les données des utilisateur.
     * 
     * 
     * @require bdd.php Fichier contenant les définition du model bdd
     * @require Connexion.php Fichier contenant les définition du model Connexion
     */
    require($racine."model/bdd.php");
    use bdd\BDD;
    require($racine."model/Connexion.php");
    use bdd\Connexion;
    use bdd\ListeUtilisateur;

    /**
     * récupère les informations de l'utilsateur grace a la methode de ListeUtilisateur getUtil
     * grace au session, ce qui permettra de récupèrer individuelement les utilisateur grace a la class Utilisateur
     * 
     * @var ListeUtilisateur $GetUtil Contient les méthode de ListeUtilisateur dans model
     * @param int $_SESSION["id"] contient l'id de l'utilisateur
     * @param string $_SESSION["email"] contient l'email de l'utilisateur
     * @return Utilisateur $GetUtil->get_Util renvoie un Utilisateur pour récupére ses informations
     * @var Utilisateur $Utilisateur Contient les méthode de Utilisateur dans model
     * @var string $nom Contient le nom de l'utilisateur
     * @var string $prenom Contient le prenom de l'utilisateur
     * @var string $email Contient l'email de l'utilisateur
     */
    $GetUtil = new ListeUtilisateur();
    $Utilisateur = $GetUtil->get_Util($_SESSION["id"], $_SESSION["email"]);

    $nom = $Utilisateur->getnom();
    $prenom = $Utilisateur->getPrenom();
    $email = $Utilisateur->getemail();

    /**
     * Permet la déconnexion de l'utilisateur grace un bouton via GET
     * 
     * @var string $log Permet de savoir si l'utilisateur à décider de ce déconnecter en appuyant sur le bouton
     * @var Connexion $deco Contient les methode de Connexion du model
     * @param string $_SESSION["email"] Contient l'email de l'utilisateur
     * @param string $_SESSION["mtp"] Contient le mot de passe de l'utilisateur
     * @return void $deco->deconnexion permet la déconnexion en supprimant et détruisant la session de l'utilisateur
     */
    if(isset($_GET['logout'])){
        $log = $_GET['logout'];
        if($log == "deco"){
            $deco = New Connexion($_SESSION["email"], $_SESSION["mtp"]);
            $deco->deconnexion();
        }
    }

    //inclusion la page profile
    include($racine."templates/php/PageProfile.php");

    //inclusion du pied de page
    include($racine."templates/php/footer.php");
?>