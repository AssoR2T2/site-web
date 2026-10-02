<?php

/**
*   Permet la'Inscription de l'utilisateur au site
*
*   @author Walid Rémi
*   
*/
namespace inscription;
use \PDO;

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


class Inscription{
    /**
     * Représente le nom de l'utilisateur
     * @var string
     */
	private $nom;
    /**
     * Représente le prenom de l'utilisateur
     * @var string
     */
	private $prenom;
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
     * Représente la confirmation du mot de passe de l'utilisateur
     * @var string
     */
    private $confmotdepasse;

    /**
     * Constructeur du model Connexion
     * 
     * @param string $nom Contient le nom de l'utilisateur
     * @param string $prenom Contient le prenom de l'utilisateur
     * @param string $email Contient l'email de l'utilisateur
     * @param string $motdepasse Contient le mot de passe de l'utilisateur
     * @param string $confmotdepasse Contient la confirmation mot de passe de l'utilisateur
     * @return void
     */
    public function __construct($nom,$prenom,$email,$mdp,$cmdp){
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->email=$email;
        $this->motdepasse=$mdp;
        $this->confmotdepasse=$cmdp;   
    }
    
    /**
     * Vérfie si le mot de passe de l'utilisateur est conforme a celui de la confirmation du mot de passe, 
     * si tel est le cas sa renvoie true
     * 
     * @var string $this->motdepasse Contient le mot de passe saisi par l'utilisateur
     * @var string $this->confmotdepasse Contient la confirmation du mot de passe saisi par l'utilisateur
     * @return true si le mot de passe est conforme
     * @return false si le mot de passe n'est pas conforme
     */
    public function verifie_mdp(){
        //compare le mot de passe avec le mot de passe de confirmation et renvoie vrai si les deux sont identique
        if ($this->motdepasse == $this->confmotdepasse){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Vérfie si l'email de l'utilisateur existe dans la base de donnée, grace a une requete sql
     * si tel est le cas sa renvoie false
     * 
     * @var BDD $bdd Contient les methode du model BDD
     * @var string $sql Contient les requête sql
     * @var array $result contient le résultat de la requête sql
     * @var string|bool $result Contient l'email si il existe dans la bdd, dans le cas contraire il contient false
     * @var string Contient les requête sql
     * @var array contient le résultat de la requête sql
     * @return false si l'email existe
     * @return true si l'email n'existe pas
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
        //si il n'est pas présent alors la requete retourne false
        if($result == false){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Fait appel aux méthode verifEmail et verifie_mdp.
     * Pour assurer l'inscription a l'utilisateur, chaque méthode doit renvoie vrai, dans le cas contraire un message
     * d'erreur apparaitra informant l'utilisateur du probleme.
     * Une fois validé execute la requête sql et l'insere dans la base de donnée.
     *
     * @var BDD $bdd Contient les methode du model BDD
     * @var string $sql Contient les requête sql
     * @return true si l'inscription est reussi
     * @return false si la'inscription a échoué
     */
    public function creer_compte(){
        //permet verifier si le mot de passe est bon et si l'adresse mail est déjà présente dans la base de donnée puis il crée un compte utilisateur 
        if ($this->verifie_mdp()){
            if ($this->verifEmail()){
                try{
                    $bdd = new BDD();
                    $bdd->Connexion();

                    $sql="insert into utilisateur(nom, prenom, email, mtp, booladmin, banni) values(:nom, :prenom, :email, :mtp, :booladmin, :banni);";
                    $stat = $bdd->con->prepare($sql);
                    $stat->execute([
                        ':nom' => $this->nom,
                        ':prenom' => $this->prenom,
                        ':email' => $this->email,
                        ':mtp' => $this->motdepasse,
                        ':booladmin' => 1,
                        ':banni' => 0
                    ]);
                }
                catch(PDOException $e){
                    echo "Erreur : ".$e->getMessage();
                }
            }
            else{
                echo "Impossible de créér un compte, l'email exite déjà.";
            }
        }
        else{
            echo "Impossible de créer un compte, la confirmation du mot de passe est différent du mot de passe.";
        }
    }
}



?>