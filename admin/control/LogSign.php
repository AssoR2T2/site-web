<?php    /**
    *   Fichier de control qui gere la connexion et l'inscription de l'utilisateur.
    *
    *   @author Walid Rémi
    */

    $title = "LogSign";//Représente le titre de la page
    $racine= "../";//Représente un chemin en arrière depuis se fichier
    
    /**
     * Inclusion des fichier Inscription.php et Connexion.php situé dans le dossier modèle.
     * 
     * Ces fichier contient les définitions et implémentations nécessaires pour
     * gérer les connexion et inscriptions de l'utilisateur. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les données des utilisateur.
     *
     * @require Inscription.php Fichier contenant les définitions du model Inscription.
     * @require Connexion.php Fichier contenant les définitions du model Connexion.
     */
    include($racine."control/Header.php");
    require($racine."model/Inscription.php");
    require($racine."model/Connexion.php");
    
    use inscription\Inscription;
    use bdd\Connexion;
   /**
     * Ouvre la page d'inscription ou la page de connexion en fonction du choix de l'utilisateur via GET
     * 
     * @var string $page vérifie dans quel page l'utilisateur souhaite se rendre, soit dans Login ou SignIn.
     */
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
                /**
         * Gère, Vérifie et transmet la de connexion de l'utilisateur via POST
         * Permet le remplissage automatique dans le formulaire si l'utilsiateur accepte les cookies
         * essentiel ou non essentiel.
         * Vérifie la précense et la conformité du token CRSF pour plus de sécurtié
         * 
         * @var string $emailF contient l'email de l'utilsateur ou une chaine vide.
         * @var string $mdpF contient le mot de passe de l'utilsiateur ou une chaine vide.
         * @var string $email l'email de l'utilisateur.
         * @var string $password le mot de passe de l'utilsateur
         * @var Connexion $Connexion Permet la Conformité des informations via la methode du model Connexion
         * @return bool $Connexion->connexion() renvoye si la connexion est une reussi (true) ou un echec (flase)
         */
        if($page == "Login"){

            if(isset($_COOKIE["identifiant"]) && $_COOKIE["mdp"]){
                $emailF = $_COOKIE["identifiant"];
                $mdpF = $_COOKIE["mdp"];
            }
            else{
                $emailF = "";
                $mdpF = "";
            }

            //inclusion de la page de connexion
            include($racine."templates/php/Login.php");

            if(isset($_POST['emailLog']) && isset($_POST['passwordLog'])){
                $email = $_POST['emailLog'];
                $password = $_POST['passwordLog'];

                $Connexion = new Connexion($email, $password);

               //essaye de se connecte a la base de donné
                if($Connexion->connexion()){
                    header("Location: Confirmation-connexion-administrateur");
                    exit;
                }
            }
            
        }

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
         * @param string $mtp représente le mot de passe de l'utilsateur
         */

        else if($page == "SignIn"){

            if(isset($_POST['email']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['password']) && isset($_POST['Confpassword'])){
                $email = $_POST['email'];
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $mtp = $_POST['password'];
                $ConfPassword = $_POST['Confpassword'];
                
               
                $NewUser = new Inscription($nom, $prenom, $email, $mtp, $ConfPassword);
                
                $NewUser->creer_compte();

                header("Location: Confirmation-Inscription-administrateur");
                exit;
            }

            include($racine."templates/php/SignIn.php");
        }
    }
    else {
        if(isset($_COOKIE["identifiant"]) && isset($_COOKIE["mdp"])){
            $emailF = $_COOKIE["identifiant"];
            $mdpF = $_COOKIE["mdp"];
        }
        else{
            $emailF = "";
            $mdpF = "";
        }
    
        if(isset($_POST['emailLog']) && isset($_POST['passwordLog'])){
            $email = $_POST['emailLog'];
            $password = $_POST['passwordLog'];

            $Connexion = new Connexion($email, $password);

            if($Connexion->connexion()){
                header("Location: Confirmation-connexion-administrateur");
                exit;
            }
        }

              //inclusion de la page d'inscription
        include($racine."templates/php/Login.php");
    }
//inclusion du pied de page
    include($racine."templates/php/footer.php");
?>
