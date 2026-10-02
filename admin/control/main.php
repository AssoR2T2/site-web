<?php
/**
*   Fichier de contrôle qui ouvre la page d'acceuil du mode admin.
*   @author Walid Rémi
*   
*/
    $racine="../";//chemin racine du projet
    $title = "Accueil";//Titre de la page

    //inclusion de l'en-tête de page
    include($racine."control/Header.php");

    /**
     * Inclusion des fichier Inscription.phpsitué dans le dossier modèle.
     * 
     * Ces fichier contient les définitions et implémentations nécessaires pour
     * gérer l'inscriptions de l'utilisateur. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les données des utilisateur.
     *
     * @require Inscription.php Fichier contenant les définitions du model Inscription.
     */
    require($racine."/model/Inscription.php");
    use inscription\Inscription;

    //inclusion de la page d'accueil
    include($racine."templates/php/Accueil.php");
    
    /**
         * Gère, Vérifie et transmet la d'inscirption de l'utilisateur via POST
         * Vérifie la précense et la conformité du token CRSF pour plus de sécurtié.
         * 
         * @var string $email représente l'email de l'utilisateur.
         * @var string $prenom représente le prenom de l'utilisateur.
         * @var string $nom représente le nom de l'utilisateur.
         * @var string $mtp représente le mot de passe de l'utilsateur
         * @var string ConfPassword représente la confirmation du mot de passe inscrit par l'utilisateur
         * @var Inscription $NewUser Permet la création d'un nouvelle utilisateur grace au information
         * @param string $email représente l'email de l'utilisateur.
         * @param string $prenom représente le prenom de l'utilisateur.
         * @param string $nom représente le nom de l'utilisateur.
         * @
         * 
        */
    if(isset($_POST['email']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['password']) && isset($_POST['Confpassword'])){
        $email = $_POST['email'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $mtp = $_POST['password'];
        $ConfPassword = $_POST['Confpassword'];
                
        //envoye les donnée dans la bdd grace a la methode creer_compte
        $NewUser = new Inscription($nom, $prenom, $email, $mtp, $ConfPassword);
                
        $NewUser->creer_compte();
    }

    
    //inclusion du pied de page
    include($racine."templates/php/footer.php");
?>