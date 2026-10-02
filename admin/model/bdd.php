<?php
/**
*   Représente la base de données.
*	Permet la connexion ou la deconnexion a la base de donnée
*
*   @author Walid Rémi
*   
*/

namespace bdd;

/**
 * Inclusion du Fichier config.php servant a la récupération des CONSTANTE pour les information du serveur
 */
include($racine."model/config.php");


class BDD{
	/**
	 * Permet la connexion ou la deconnexion avec la bdd
	 * @var PDO
	 */
	public $con;

	/**
	 * Permet la connexion a la base de donnée, si il peut, dans le cas contraire une erreur sera afficher
	 * 
	 * @throws PDOException si une erreur survient dans la connexion a la bdd
	 * @return void
	 */
	public function Connexion(){
		try{
			$this->con = new \PDO("pgsql:host=".SERVERNAME.";port=".PORT.";dbname=".DBNAME, USERNAME, PWD);
		}
		catch(\PDOException $e){
			echo "PDOErreur : ".$e->getMessage();
		}
	}

	/**
	 * Permet la deconnexion de la base de donnée
	 * 
	 * @return void
	 */
	public function deconnexion(){
		$this->con = null;
	}
};
?>