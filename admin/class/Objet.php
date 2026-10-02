<?php
/**
*   Représente un objet avec ses informations de base.
*
*   @author Walid Rémi
*   
*/
    namespace objet;

    class Objet{
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
     * Constructeur de la classe Objet
     * 
     * @param int $id_aut ID de l'utilisateur qui a créé l'Objet
     * @param string $nom Nom de l'Objet
     * @param string $lieu lieu de l'Objet
     * @param string $descrip description de l'Objet
     * @param string $etat Etat de l'Objet
     * @param string $date date de l'Objet
     * @param string $photo l'image de l'Objet
     */

        public function __construct($nom, $lieu, $descrip, $etat, $date, $id_aut, $photo){
            $this->nom=$nom;
            $this->lieu=$lieu;
            $this->descrip=$descrip;
            $this->etat=$etat;
            $this->date=$date;
            $this->id_aut=$id_aut;
            $this->photo=$photo;
        }

/**
     * Renvoie le nom de l'objet
     * 
     * @return string
     */
        
        public function getnom(){
            return $this->nom;
        }
        /**
     * Renvoie le lieu où a été trouvé ou perdu l'objet
     * 
     * @return string
     */
        public function getlieu(){
            return $this->lieu;
        }
        /**
     * Renvoie la description de l'objet
     * 
     * @return string
     */
        public function getdescrip(){
            return $this->descrip;
        }
        /**
     * Renvoie l'etat de l'objet
     * 
     * @return string
     */
        public function getetat(){
            return $this->etat;
        }
        /**
     * Renvoie la date de quand l'objet a été perdu ou trouvé 
     * 
     * @return string
     */
        public function getdate(){
            return $this->date;
        }
        /**
     * Renvoie l'ID de l'objet
     * 
     * @return int
     */
        public function getid(){
            return $this->id;
        }
        /**
     * Renvoie l'ID de l'utilisateur créateur de l'objet
     * 
     * @return int
     */
        public function getid_aut(){
            return $this->id_aut;
        }
        /**
     * Renvoie les noms des images de l'objet
     * 
     * @return string
     */
        public function getphoto(){
            return $this->photo;
        }
        

    }
















?>