<?php
/**
*   Permet la récupération d'un ou plusieurs utilisateur,
*   permet également leur suppresion et la modification des utilisateurs.
*
*   @author Walid Rémi
*   
*/
    namespace bdd;
    use \PDO;

    /**
     * Inclusion du fichier Utilisateur.php situé dans le dossier modèle.
     *
     * Ce fichier contient les définitions et implémentations nécessaires pour
     * gérer les Utilisateur dans le projet. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les données des Utilisateur.
     *
     * @require Utilisateur.php Fichier contenant les définitions de la class Utilisateur.
     */
    require($racine."class/Utilisateur.php");
    use \Control\Utilisateur;

    class ListeUtilisateur{
        /**
         * Permet la récupération de tous les utilisateurs présents dans la base de donnée
         * et les renvoient sous forme de tableau
         * 
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @var array $Util contient le résultat de la requête sql
         * @return array
         */
        public function ListeUtil(){
            $bdd = new BDD();
            $bdd->Connexion();
            //récupere tout les donnée des utilisateurs
            $sql = "SELECT *
             FROM utilisateur;";
            $stat = $bdd->con->prepare($sql);
            $stat->execute();
            $Util = $stat->fetchAll(PDO::FETCH_ASSOC);
            $bdd->deconnexion();

            return $Util;
        }

        /**
         * Permet la suppresion de un utilisateur présent dans la base de donnée
         * 
         * @param int $id_util Contient l'ID de l'utilisateur
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @return void
         */
        public function removeUtil($id_util){
            //supprime l'utilisateur grace a l'id
            $bdd = new BDD();
            $bdd->Connexion();
            $sql="DELETE FROM utilisateur WHERE idutilisateur=$id_util;";
            $stat = $bdd->con->prepare($sql);
            $stat->execute();
            $bdd->deconnexion();
        }
 
/**
         * Permet la modification de un utilisateur présent dans la base de donnée
         * 
         * @param int $id_util Contient l'ID de l'utilisateur
         * @param string $nom Contient le nom de l'utilisateur
         * @param string $prenom Contient le prenom de l'utilisateur
         * @param string $email Contient l'email de l'utilisateur
         * @param string $mdp Contient le mot de passe de l'utilisateur
         * @param bool $admin Contient l'admin de l'utilisateur
         * @var array $ALLUtilisateur Contient sou forme de tableau tous les utilisateurs
         * présents dans la base de données
         * @var bool $stop Vérifie si les modifications sont conforme
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @throws PDOException tente d'execute la requete sql, si s aechoue alors il renvoie une erreur
         * @return void
         */
        public function modifieUtil($id_util,$nom,$prenom,$email,$mdp,$admin){
            $ALLUtilisateur = $this->ListeUtil();
            //modifie les informations de l'utilisateur
            $stop=true;
            //vérifie si la nouvelle email n'existe pas dans la bdd
            foreach($ALLUtilisateur as $utilisateurs){
                if($utilisateurs['email'] == $email && $_SESSION["email"] != $email) {
                    $stop = false;
                    break;
                }
            }
            
            if($stop){
                $bdd = new BDD();
                $bdd->Connexion();


                //modifie les informations grace au argument
                $sql="UPDATE utilisateur
                SET nom=:nom, prenom=:prenom, email=:email, mtp=:mtp, booladmin=:admin
                WHERE idutilisateur=:idutilisateur;";
                $stat = $bdd->con->prepare($sql);
                $stat->bindParam(':nom', $nom);
                $stat->bindParam(':prenom', $prenom);
                $stat->bindParam(':email', $email);
                $stat->bindParam(':mtp', $mdp);
                $stat->bindValue(':admin', $admin, PDO::PARAM_BOOL);
                $stat->bindParam(':idutilisateur', $id_util);
                $bdd->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                try{
                    $stat->execute();
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
                $bdd->deconnexion();
            }
            else{
                echo "<p class=\"center\"> l'email existe déjà</p>";
            }
        }

        /**
         * Permet de ban ou déban l'utilsateur grace a son id via GET
         * 
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @return void
         */
        public function Unban($id){
            $bdd = new BDD();
            $bdd->Connexion();

            //ban ou deban l'utilisateur
            $id_util = intval($id);
            $sql="UPDATE utilisateur
            SET banni = NOT banni
            WHERE idutilisateur=$id_util;";
            $stat = $bdd->con->prepare($sql);
            $stat->execute();
            $bdd->deconnexion();
        }
        
        /**
         * Permet la récupération d'un utilisateur présent dans la base de donnée
         * et les renvoient sous forme d'instance
         * 
         * @param int $id_util Contient l'id de l'utilisateur
         * @param string $email Contient l'email de l'utilisateur
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @var Utilisateur $NewUtilisateur crée une instance de l'utilisateur
         * @param int $Util['idutilisateur'] Contient l'id de l'utilisateur
         * @param string $Util['nom'] Contient le nom de l'utilisateur
         * @param string $Util['email'] Contient l'email de l'utilisateur
         * @param string $Util['prenom'] Contient le prenom de l'utilisateur
         * @param string $Util['mtp'] Contient le mot de passe de l'utilisateur
         * @return Utilisateur
         */
        public function get_Util($id_util, $email){
            $bdd = new BDD();
            $bdd->Connexion();
            
            //envoye les informations de l'utilisateur grace a l'id
            //crée une instance d'utilisateur et renvoye l'objet
            if($id_util == '') $id_util = -1;

            $sql = "SELECT *
             FROM utilisateur
             WHERE (idutilisateur=:idutilisateur or email=:email);";
            $stat = $bdd->con->prepare($sql);
            $stat->bindParam(':idutilisateur', $id_util);
            $stat->bindParam(':email', $email);
            $stat->execute();
            $Util = $stat->fetch();
            $bdd->deconnexion();
            $NewUtilisateur = new Utilisateur($Util['idutilisateur'], $Util['nom'], $Util['prenom'], $Util['email'], $Util['mtp']);

            return $NewUtilisateur;
        }

        
    }


    


?>