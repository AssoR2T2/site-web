<?php
/**
*   Gère et control la modification de l'utilisateur
*
*   @author Walid Rémi
*   
*/
    $racine = '../';//racine du projet
    $title = "Modifier l'utilisateur";//titre de la page
    //inclusion de l'en-tête de page
    include($racine."control/Header.php");
     /**
     * inclusion du fichier bdd.php situé dans le dossier model
     * inclusion du fichier ListeUtilisateur.php situé dans le dossier model
     * 
     * le fichier bdd contient les implémentations nécessaire pour gérer
     * la base de donnée. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec la base de donnée.
     * 
     * Le fichier ListeUtilisateur contient les implémentations nécessaire pour gérer un ou tout les utilisateurs
     * existant dans la base de donnée. Il est requis pour assurer le bon fonctionnement du
     * contrôle et de interactions avec les utilisateurs.
     * 
     * @require bdd.php Fichier contenant les définition du model bdd
     * @require ListeUtilsiateur.php Fichier contenant les définition du model ListeUtilisateur
     */
    require($racine."model/bdd.php");
    use bdd\BDD;
    require($racine."model/ListeUtilisateur.php");
    use bdd\ListeUtilisateur;

    /**
     * Gere, control et vérifie les informations saisie de l'utilisateur et l'existence du token CRSF
     * Permet de réaliser la modification des informations de son compte utilisateur.
     * Permet également la vérification du toekn CRSF pour plus de sécurité
     * 
     * @var string $nom contient le nom de l'utilisateur
     * @var string $prenom contient le prenom de l'utilisateur
     * @var string $email contient l'email de l'utilisateur
     * @var string $mtp contient le mot de passe de l'utilisateur
     * @var int $id contient l'ID de l'utilisateur
     * @var ListeUtilisateur $ModifUtil contient l'objet ListeUtilisateur du model
     * 
     * @param int $id contient l'ID de l'utilisateur
     * @param string $nom contient le nom de l'utilisateur
     * @param string $prenom contient le prenom de l'utilisateur
     * @param string $email contient l'email de l'utilisateur
     * @param string $mtp contient le mot de passe de l'utilisateur
     * @param bool $admin dit si l'utilisateur est un administrateur ou pas, ici l'utilisateur n'est pas administrateur
     */
    #permet de réaliser une modification a son compte utilisateur

    if(isset($_GET['id']) && isset($_POST['nomUtil']) && isset($_POST['prenomUtil']) && isset($_POST['email']) && isset($_POST['Admin']) &&isset($_POST['mtp'])){
        $nom = $_POST['nomUtil'];
        $prenom = $_POST['prenomUtil'];
        $email = $_POST['email'];
        $admin = $_POST['Admin'];
        $mtp = $_POST['mtp'];
        $id = $_GET['id'];

        $idutilisateur = intval($id);
        if($admin == "true") $boolAdmin = true;
        else $boolAdmin = false;

        $ModifUtil = new ListeUtilisateur();
        $ModifUtil->modifieUtil($idutilisateur, $nom, $prenom, $email, $mtp, $boolAdmin);
        
        header("Location: Confirmation-modifUtil-administrateur");
        exit;
    }

    //inclusion du formulaire de modification de l'utilisateur
    include($racine."templates/php/ModifUtilisateur.php");
 //inclusion du pied de page de l'utilisateur
    include($racine."templates/php/footer.php");
?>