<?php
/**
*   Représente un utilisateur avec ses informations de base.
*
*   @author Walid Rémi
*   
*/
namespace Control;

class Utilisateur{
    /**
     * ID de l'utilisateur
     * @var int
     */
	private $id;
    /**
     * Nom de l'utilisateur
     * @var string
     */
	private $nom;
    /**
     * Prenom de l'utilisateur
     * @var string
     */
	private $prenom;
    /**
     * Email de l'utilisateur
     * @var string
     */
    private $email;
    /**
     * Mot de passe de l'utilisateur
     * @var string
     */
    private $motdepasse; 

	/**
     * Constructeur de la classe Utilisateur
     * 
     * @param int $id ID de l'utilisateur
     * @param string $nom Nom de l'utilisateur
     * @param string $prenom Prenom de l'utilisateur
     * @param string $email Email de l'utilsateur
     * @param string $motdepasse Mot de passe de l'utilisateur
     */

	public function __construct($id, $nom, $prenom, $email,$motdepasse){
		$this->nom=$nom;
        $this->prenom=$prenom;
        $this->email=$email;
        $this->motdepasse=$motdepasse;
        $this->id = $id;
	}

    /**
     * Renvoie le nom de l'utilisateur
     * 
     * @return string
     */
    public function getnom(){
        return $this->nom;
    }

    /**
     * Renvoie le prenom de l'utilisateur
     * 
     * @return string
     */
    public function getprenom(){
        return $this->prenom;
    }

    /**
     * Renvoie l'email de l'utilisateur
     * 
     * @return string
     */
    public function getemail(){
        return $this->email;
    }

    /**
     * Renvoie l'ID de l'utilisateur
     * 
     * @return int
     */
    public function getid(){
        return $this->id;
    }

    /**
     * Renvoie le mot de passe de l'utilisateur
     * 
     * @return string
     */
    public function getmdp(){
        return $this->motdepasse;
    }
}
?>


