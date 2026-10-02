<?php
/**
*   Permet la Connexion de l'utilisateur au site
*
*   @author Walid Rémi
*   
*/
namespace bdd;

/**
 * inclusion du fichier ListeUtilisateur.php situé dans le dossier model
 * 
 * Le fichier ListeUtilisateur contient les implémentations nécessaire pour gérer un ou tout les utilisateurs
 * existant dans la base de donnée. Il est requis pour assurer le bon fonctionnement du
 * contrôle et de interactions avec les utilisateurs.
 * 
 * @require ListeUtilsiateur.php Fichier contenant les définition du model ListeUtilisateur
 */
require($racine."model/ListeUtilisateur.php");
use bdd\ListeUtilisateur;

use \PDO;

class Connexion{
    /**
     * Représente l'email de l'utilisateur
     * @var string
     */
    private $email;
    /**
     * Représente le mot de passe de l'utilisateur
     * @var string
     */
    private $motdepasse;

    /**
     * Constructeur du model Connexion
     * 
     * @param string $email Contient l'email de l'utilisateur
     * @param string $motdepasse Contient le mot de passe de l'utilisateur
     * @return void
     */
    public function __construct($email, $mdp){
        $this->email=$email;
        $this->motdepasse=$mdp;
    }

    /**
     * Vérfie si le compte l'utilisateur est bannie via la base de donnée, grace a une requete sql
     * si tel est le cas sa renvoie false
     * 
     * @var BDD $bdd Contient les methode du model BDD
     * @var string $sql Contient les requête sql
     * @var array $result contient le résultat de la requête sql
     * @return false si l'utilisateur est bannie
     * @return true si l'utilsiateur n'est pas bannie
     */
    function verifBani(){
        //verifie si l'utilisateur n'est pas banni
        $bdd = new BDD();
        $bdd->Connexion();

        $sql="select banni from utilisateur where email = :email;";
        $stat = $bdd->con->prepare($sql);
        $stat->bindParam('email', $this->email);
        $stat->execute();
        $result = $stat->fetch();
        $bdd->deconnexion();

        if($result['banni'] == true){
            return false;
        }
        else{
            return true;
        }
    }

    /**
     * Vérfie si le mail de l'utilisateur existe dans la base de donnée, grace a une requete sql
     * si tel est le cas sa renvoie true
     * 
     * @var BDD $bdd Contient les methode du model BDD
     * @var string $sql Contient les requête sql
     * @var array $result contient le résultat de la requête sql
     * @return true si l'email existe
     * @return false si l'email n'existe pas
     */
    public function verifEmail(){

        //récupere l'email dans la bdd grace a la requette
        $bdd = new BDD();
        $bdd->Connexion();

        $sql="select email from utilisateur where email = :email;";
        $stat = $bdd->con->prepare($sql);
        $stat->bindParam('email', $this->email);
        $stat->execute();
        $result = $stat->fetch();
        $bdd->deconnexion();

        //vérifie si l'email est présent dans la bdd
        //si il est pas présent alors la requete retourne true
        if(isset($result['email'])){
            if(trim($result['email']) != trim($this->email)){
                return false;
            }
            else if(trim($this->email) == trim($this->email)){
                return true;
            }
        }
        else{
            return false;
        }
    }

    /**
     * Vérfie si le mot de passe de l'utilisateur est conforme a celui dans la base de donnée, 
     * grace a une requete sql
     * si tel est le cas sa renvoie true
     * 
     * @var BDD Contient les methode du model BDD
     * @var string Contient les requête sql
     * @var array contient le résultat de la requête sql
     * @return true si le mot de passe est conforme
     * @return false si le mot de passe n'est pas conforme
     */
    public function verifieMdp(){
        $bdd = new BDD();
        $bdd->Connexion();

        //récupere le mot de passe en fonction du mail entrée

        $sql="SELECT mtp from utilisateur where email=:email;";
        $stat = $bdd->con->prepare($sql);
        $stat->bindParam('email', $this->email);
        $stat->execute();
        $result = $stat->fetch();
        $bdd->deconnexion();

        //compare le mot de passe récuperé dans la bdd avec le mot de passe entrée
        if($result['mtp'] == $this->motdepasse) {
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Fait appel aux méthode verifBani, verifEmail et verifieMdp.
     * Pour assurer la connexion du l'utilisateur, chaque méthode doit renvoie vrai, dans le cas contraire un message
     * d'erreur apparaitra informant l'utilisateur du probleme.
     * SI les cookies ont était accepte alors nous créont 2 cookies qui récupère le mail et le mot de passe de l'utilisateur
     * 
     * @var ListeUtilisateur $ModifUtil contient l'objet ListeUtilisateur du model
     * @var Utilisateur $NewUtilisateur Contient les information de base de l'utilisateur 
     * @var bool $_SESSION["connecte"] Contient le statut de connexion de l'utilisateur
     * @var string $_SESSION["email"] Contient l'email de l'utilisateur
     * @var string $_SESSION["mtp"] Contient le mot de passe de l'utilisateur
     * @var int $_SESSION["id"] Contient l'id de l'utilisateur
     * @return true si la connexion est reussi
     * @return false si la connexion a échoué
     */
    public function connexion(){
        if ($this->verifEmail()){
            if($this->verifBani()){
                if($this->verifieMdp()){
                    $Utilisateur = new ListeUtilisateur();
                    $NewUtilisateur = $Utilisateur->get_Util('', $this->email);
                    
                    $_SESSION["connecte"] = true;
                    $_SESSION["email"]= $NewUtilisateur->getemail();
                    $_SESSION["mtp"]=$NewUtilisateur->getmdp();
                    $_SESSION["id"]= $NewUtilisateur->getid();
                    if(isset($_COOKIE["cookieAccept"])){
                        if($_COOKIE["cookieAccept"] == "oui" || $_COOKIE["cookieAccept"] == "ouiP"){
                            setcookie("identifiant", $_SESSION["email"], time() + (86400*10), "/");
                            setcookie("mdp", $_SESSION["mtp"], time() + (86400*10), "/");
                        }
                    }
                    
                    return true;
                }
                else{
                    echo "<p class=\"erreurIncorrecte\">le mot de passe incorrecte</p>";
                    return false;
                }
            }
            else{
                echo "<p class=\"erreurIncorrecte\">vous avez était banni</p>";
                return false;
            }
        }
        else{
            echo "<p class=\"erreurIncorrecte\">l'email incorrecte ou n'existe pas</p>";
            return false;
        }  
    }

    /**
     * déconncte l'utilisateur en supprimant les informations contenue dans les sessions
     * puis détruit les sessions avant de le renvoie a la page d'accueil
     * 
     * @return void
     */
    public function deconnexion(){
        session_unset();
        session_destroy();
        header("Location: Accueil");
        exit;
    }
}



?>