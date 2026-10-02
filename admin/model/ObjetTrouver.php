<?php
/**
*   Représente un Objet Trouve qui hérite de la class Objet.
*
*   @author Walid Rémi
*   
*/
    namespace objet;
    use \PDO;
    

    class ObjectTrouver extends Objet{
        /**
         * racine du projet
         * @var string
         */
        private $racine;

         /**
         * Constructeur du model objetPerdu
         * 
         * @param string $nom Contient le nom de l'objet
         * @param string $lieu Contient le lieu de l'objet
         * @param string $descrip Contient la description de l'objet
         * @param int $id_aut Contient l'id de l'objet
         * @param array $photo Contient les liens de photo de l'objet
         * @param string $racine Contient la racine de l'objet
         */
        public function __construct($nom, $lieu, $descrip, $date, $id_aut, $photo, $racine){
            parent::__construct($nom, $lieu, $descrip, 'trouver', $date, $id_aut, $photo);
            $this->racine = $racine;

        }

        /**
         * Permet l'ajout d'objet Perdu dans la base de donnée dans ce cas l'utilisateur a l'obligation
         * d'ajotuer une photo, dans le cas contraire uen erreur sera renvoie
         * 
         * @var BDD $bdd Contient les methode du model BDD
         * @var string $sql Contient les requête sql
         * @var array $idObjet contient le résultat de la requête sql
         * @var array $photo contient des liens vers les photos
         * 
         */
        public function ajouterBdd(){
                $bdd = new \bdd\BDD();
                $bdd->Connexion();

                
                $photo = $this->getphoto();
                //l'objet trouve doit obligatoirement avoir au moins une photo donc ont vérifie si il la premiere photo existe
                if($photo['name'][0] != "") {

                    //ajoute un objet dans la bdd
                    $sql="insert into objet(nomObjet, date, lieu, description, idutilisateur, etat) values(:nomObjet, :date, :lieu, :description, :idutilisateur, :etat)
                    RETURNING id;";
                    $stat = $bdd->con->prepare($sql);
                    $stat->execute([
                        ':nomObjet' => $this->getnom(),
                        ':date' => $this->getdate(),
                        ':lieu' => $this->getlieu(),
                        ':description' => $this->getdescrip(),
                        ':idutilisateur' => $this->getid_aut(),
                        ':etat' => $this->getetat()
                    ]);
                    $idObjet = $stat->fetchColumn();

                    //stock les photos dans un dossier du serveur
                    foreach($_FILES['photo']['tmp_name'] as $key => $tmpName){
                        $name = $_FILES['photo']['name'][$key];
                        $uniqName = $idObjet.'_'.$key.'_'.$name;
                        $destination = $this->racine.'../image/objet/'.$uniqName;
                        move_uploaded_file($tmpName, $destination);
                        $linkPhoto[] = $uniqName;
                    }

                    $sql="insert into photo(idobjet";
                    $values="values(:idobjet";
                    $param=[':idobjet' => $idObjet];
                    //ont stock les liens des photo qui existe
                    if(!empty($linkPhoto[0])){
                        $sql .= ', linkphoto1';
                        $values .= ', :linkphoto1';
                        $param[':linkphoto1'] = $linkPhoto[0];
                        if(!empty($linkPhoto[1])){
                            $sql .= ', linkphoto2';
                            $values .= ', :linkphoto2';
                            $param[':linkphoto2'] = $linkPhoto[1];
                        }
                    }
                    $sql .= ") $values);";
                    $stat = $bdd->con->prepare($sql);
                    $stat->execute($param);
                }
                else{
                    echo "<p class=\"erreurIncorrecte\">vous devez mettre obligatoirement au moins un photo!!!</p>";
                }

                $bdd->deconnexion();
        }
    }







?>