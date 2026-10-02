<?php
/**
*   Permet la récupération d'un ou plusieurs Objet,
*   permet également leur suppresion et la modification des Obejt.
*
*   @author Walid Rémi
*   
*/
    namespace bdd;

    /**
     * Inclusion du fichier Objet.php situé dans le dossier modèle avec l'alias NewObjete.
     *
     * Ce fichier contient les définitions et implémentations nécessaires pour
     * gérer l'Objet dans le projet. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les données de l'Objet.
     *
     * @require Objet.php Fichier contenant les définitions de la class Objet.
     */
    require($racine."class/Objet.php");
    use \objet\Objet as NewObjet;


    class Objet{
        /**
         * Permet la récupération de tous les Objet présents dans la base de donnée
         * et les renvoient sous forme de tableau
         * 
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @var array $Objet contient le résultat de la requête sql
         * @return array
         */
        public function listeObjet(){
            $bdd = new BDD();
            $bdd->Connexion();

            //fusionne 2 table pour récuperer les données
            $sql = "SELECT objet.id, objet.nomobjet, objet.date, objet.lieu, objet.idutilisateur, objet.etat,  
            utilisateur.nom, utilisateur.prenom, photo.linkphoto1, photo.linkphoto2 from objet 
            INNER JOIN utilisateur on objet.idutilisateur = utilisateur.idutilisateur
            INNER JOIN photo on objet.id = photo.idobjet;";
            $stat = $bdd->con->prepare($sql);
            $stat->execute();
            $Objet = $stat->fetchAll();
            $bdd->deconnexion();

            return $Objet;
        }

/**
         * Permet la suppresion d'un objet présent dans la base de donnée
         * Si une image existe il la supprime dans la cas contraire il ne fait rien
         * 
         * @param int $id_obj Contient l'ID de l'objet
         * @var array $suppObjets Contient les informations de l'objet et de son utilisateur sous forme de tableau
         * @var array $suppObjet Contient les informations de l'objet
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @return void
         */
        public function removeObject($id_obj){
            //permet de retiré de la base de donnée l'objet qui a pour pour id la valeur entrée
            $bdd = new BDD();
            $bdd->Connexion();

            $suppObjets = $this->getObjet($id_obj);
            $suppObjet = $suppObjets[0];
            $imageObjet = $suppObjet->getphoto();
            if (file_exists("/~uapv2402240/image/objet/".$imageObjet['linkphoto1'])){
                unlink("/~uapv2402240/image/objet/".$imageObjet['linkphoto1']);
                if (isset($imageObjet['linkphoto2'])){
                    unlink("/~uapv2402240/image/objet/".$imageObjet['linkphoto2']);
                }
            }
            $sql = "DELETE from objet where id = $id_obj;";
            $stat = $bdd->con->prepare($sql);
            $stat->execute();
            $sql = "DELETE from photo where idobjet = $id_obj;";
            $stat = $bdd->con->prepare($sql);
            $stat->execute();
        }
 
/**
         * Permet la modification d'un objet présent dans la base de donnée
         * 
         * @param int $id_obj Contient l'ID de l'objet
         * @param string $nomObjet Contient le nom de l'objet
         * @param string $date Contient la date de l'objet
         * @param string $lieu Contient le lieu de l'objet
         * @param string $etat Contient l'etat de l'objet
         * @param string $description Contient la description de l'objet
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @return void
         */
        public function modifieObject($id_obj, $date, $lieu, $etat, $description, $nomObjet){
            //permet de modifier les attributs d'un objets de la base de données qui pour id "id_obj"
            $bdd = new BDD();
            $bdd->Connexion();
            $sql = "UPDATE objet SET date = :date, lieu = :lieu, description = :description, nomObjet = :nomObjet, etat = :etat where id = :id;";
            $stat = $bdd->con->prepare($sql);
            $stat->bindParam(':id', $id_obj);
            $stat->bindParam(':date', $date);
            $stat->bindParam(':lieu', $lieu);
            $stat->bindParam(':description', $description);
            $stat->bindParam(':nomObjet', $nomObjet);
            $stat->bindParam(':etat', $etat);
            $stat->execute();

            $bdd->deconnexion();
        }

        /**
         * Permet la récupération d'un objet présent dans la base de donnée
         * et renvoient 2 instances sous forme de tableau l'objet et l'utilisateur
         * 
         * @param int $idobjet Contient l'id de l'objet
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * 
         * @var NewObjet $utilisateur crée une instance de l'objet
         * @param int $Objet['idutilisateur'] Contient l'id de l'objet
         * @param string $Objet['nomobjet'] Contient le nom de l'objet
         * @param string $Objet['lieu'] Contient le lieu de l'objet
         * @param string $Objet['description'] Contient la description de l'objet
         * @param string $Objet['etat'] Contient l'etat de l'objet
         * @param string $Objet['date'] Contient la date de l'objet
         * @param int $Objet['idutilisateur'] Contient l'ID de l'utilisateur lié à l'objet
         * @param array $photo contient les liens des photos de l'objet
         * 
         * @var Utilisateur $utilisateur crée une instance de l'utilisateur
         * @param int $Objet['idutilisateur'] Contient l'id de l'utilisateur
         * @param string $Objet['nom'] Contient le nom de l'utilisateur
         * @param string $Objet['email'] Contient l'email de l'utilisateur
         * @param string $Objet['prenom'] Contient le prenom de l'utilisateur
         * @param string $Objet['mtp'] Contient le mot de passe de l'utilisateur
         * 
         * @var array $ArrayObjet Contient un tableau d'instance d'objet
         * @return array
         */
        public function getObjet($idobjet){
            //permet de renvoyer sous forme d'un tableau qui contient une instance d'objets et d'utilisateur associé
            $bdd = new BDD();
            $bdd->Connexion();

            $sql="SELECT * from ((objet inner Join utilisateur on objet.idutilisateur = utilisateur.idutilisateur)
            inner join photo on objet.id = photo.idobjet) where objet.id = $idobjet;";
            $stat = $bdd->con->prepare($sql);
            $stat->execute();
            $Objet = $stat->fetch();
            $bdd->deconnexion();

            $photo = ["linkphoto1" => $Objet['linkphoto1'], "linkphoto2" => $Objet['linkphoto2']];
            
            $NewObjet = new NewObjet($Objet['nomobjet'], $Objet['lieu'], $Objet['description'], $Objet['etat'], $Objet['date'], $Objet['idutilisateur'], $photo);
            $utilisateur = new \Control\Utilisateur($Objet['idutilisateur'], $Objet['nom'], $Objet['prenom'], $Objet['email'], $Objet['mtp']);

            $ArrayObjet = array($NewObjet, $utilisateur);

            return $ArrayObjet;
        }
    }
?>