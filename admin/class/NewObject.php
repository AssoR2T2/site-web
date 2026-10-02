<?php
/**
*   Permet la création de nouveau objet en faisant appel de model
*
*   @author Walid Rémi
*   
*/
    namespace objet;

    /**
 * inclusion du fichier bdd.php situé dans le dossier model
 * inclusion du fichier Objet.php situé dans le dossier model
 * inclusion du fichier ObjetPerdu.php situé dans le dossier model
 * inclusion du fichier ObjetTrouver.php situé dans le dossier model
 * 
 * le fichier bdd contient les implémentations nécessaire pour gérer
 * la base de donnée. Il est requis pour assurer le bon fonctionnement
 * du contrôle et des interactions avec la base de donnée.
 * le fichier Objet contient les implémentations nécessaire pour gérer
 * les obejt. Il est requis pour assurer le bon fonctionnement
 * du contrôle et des interactions avec la base de donnée.
 * le fichier ObjetPerdu contient les implémentations nécessaire pour gérer
 * les Objet Perdu. Il est requis pour assurer le bon fonctionnement
 * du contrôle et des interactions avec la base de donnée.
 * le fichier ObjetTrouver contient les implémentations nécessaire pour gérer
 * les Objet Trouver. Il est requis pour assurer le bon fonctionnement
 * du contrôle et des interactions avec la base de donnée.
 * 
 * @require bdd.php Fichier contenant les définition du model bdd
 * @require Objet.php Fichier contenant les définition de la class Objet
 * @require ObjetPerdu.php Fichier contenant les définition du model ObjetPerdu
 * @require ObjetTrouver.php Fichier contenant les définition du model ObjetTrouver
 */
    require($racine."model/bdd.php");
    use bdd\BDD;

    require($racine."class/Objet.php");
    use objet\Objet;

    require($racine."model/ObjetPerdu.php");
    require($racine."model/ObjetTrouver.php");
    use objet\ObjectPerdu;
    use objet\ObjectTrouver;

    class NewObjet{
/**
     * Nom de l'objet
     * @var string
     */
    private $nom;
    /**
     * le lieu de l'objet lorsqu'il a était perdu ou trouvé
     * @var string
     */
        private $lieu;
    /**
     * description de l'objet
     * @var string
     */
        private $descrip;
    /**
     * l'etat de l'objet (si perdu ou trouver)
     * @var string
     */
        private $etat;
    /**
     * la date de l'objet lorsqu'il a était perdu ou trouvé
     * @var string
     */
        private $date;
    /**
    * ID de l'objet
    * @var int
    */
        private $id;
    /**
    * ID de l'utilisateur qui a créér l'objet
    * @var int
    */
        private $id_aut;
    /**
     *  les noms des image de l'objet
     * @var string
     */
        private $photo;
            /**
     *  le chemin racine du projet
     * @var string
     */
        private $racine;




    /**
     * Constructeur de la classe NewObjet
     * 
     * @param int $id_aut ID de l'utilisateur qui a créé l'Objet
     * @param string $nom Nom de l'Objet
     * @param string $lieu lieu de l'Objet
     * @param string $descrip description de l'Objet
     * @param string $etat Etat de l'Objet
     * @param string $date date de l'Objet
     * @param string $photo l'image de l'Objet
     * @param string $racine le chemin racine de l'objet
     */


        public function __construct($nom, $lieu, $descrip, $etat, $date, $id_aut, $photo, $racine){
            $this->nom = $nom;
            $this->lieu = $lieu;
            $this->descrip = $descrip;
            $this->date = $date;
            $this->id_aut = $id_aut;
            $this->photo = $photo;
            $this->etat=$etat;
            $this->racine = $racine;
        }
    /**
     * permet d'ajouter un objet a la base de donnée des objets en fonction de son etat
     * 
     * @var ObjectPerdu $op Contient les methode du model ObjectPerdu
     * @var ObjectTrouver $ot Contient les methode du model ObjectTrouver 
     * @return void
     */
        public function ajouterBdd(){
            if($this->etat=="perdu"){
                $op=new ObjectPerdu($this->nom, $this->lieu, $this->descrip,$this->date, $this->id_aut, $this->photo, $this->racine);
                $op->ajouterBdd();
            }
            else{
                $ot=new ObjectTrouver($this->nom, $this->lieu, $this->descrip,$this->date, $this->id_aut, $this->photo, $this->racine);
                $ot->ajouterBdd();
            }
        }
    }


?>