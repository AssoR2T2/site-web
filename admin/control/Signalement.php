<?php
/**
*   Gère, vérifie et controle les informations saisie par l'utilsiteur et Signale un objet si les informations
*   et le token CRSF sont conforme.
*
*   @author Walid Rémi
*   
*/
$racine = '../';//racine du projet
$title = "Signalement";//titre de la page

//inclusion de la page d'en-tête
    include($racine."control/Header.php");

 /**
     * inclusion du fichier NewObject.php situé dans model
     * 
     * le fichier NewObject contient les implémentations nécessaire pour gérer
     * la création de nouveau Obejt. Il est requis pour assurer le bon fonctionnement
     * du contrôle et des interactions avec les nouveaux Objet.
     * 
     * @require NewObject.php Fichier contenant les définitions du model NewObject.
     */
    require($racine."class/NewObject.php");
    use objet\NewObjet;
     /**
     * Vérifie et récupère les informations, saisie par l'utilisateur,
     * du formulaire de signalement via POST.
     * Chaque Objet est liée par son utilisateur.
     * Vérifie également qu'une photo existe car un objet n'est obligé de contenir une photo si il est perdu,
     * sauf si l'objet et trouve au quel cas l'utilisateur est obligé de rajouter un photo.
     * Vérifie également la correspondance du token CRSF pour plus de sécurité.
     * 
     * @var string $NomObjet Contient le nom de l'objet
     * @var string $date Contient le date de l'objet
     * @var string $lieu Contient le lieu de l'objet
     * @var string $description Contient la description de l'objet
     * @var string $etat Contient l'etat de l'objet
     * @var int $id Contient l'id de l'utilisateur
     * @var array|null $photo Contient une liste de lien de photo 
     * @var NewObjet $NewObjet Contient les methode du model NewObjet
     * @param string $NomObjet Contient le nom de l'objet
     * @param string $date Contient le date de l'objet
     * @param string $lieu Contient le lieu de l'objet
     * @param string $description Contient la description de l'objet
     * @param string $etat Contient l'etat de l'objet
     * @param int $id Contient l'id de l'utilisateur
     * @param array|null $photo Contient une liste de lien de photo 
     * @param string $racine Contient la racine du projet pour récupérer les photo
     */
    if($_SESSION["connecte"]){
        if(isset($_POST['nomObjet']) && isset($_POST['etat']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['description']) && isset($_POST['crsf'])){
            if($_SESSION['crsf'] == $_POST['crsf']){
                $nomObjet = $_POST['nomObjet'];
                $etat = $_POST['etat'];
                $date = $_POST['date'];
                $lieu = $_POST['lieu'];
                $description = $_POST['description'];
                $id = $_SESSION["id"];

                if(isset($_FILES['photo'])) $photo = $_FILES['photo'];
                else $photo = null;
                $NewObjet = new NewObjet($nomObjet, $lieu, $description, $etat,$date, $id, $photo, $racine);

                $NewObjet->ajouterbdd();

                header("Location: Confirmation-signalement-administrateur");
                exit;
            }
            else{
                echo "<p class\"center\"> erreur crsf token <p>";
            }
        }
    }
    else{
        echo "<h2 class=\"center\">Vous devez être connectez pour pouvoir signalez un compte</h2>";
    }

    //inclusion du formulaire de signalement
    include($racine."templates/php/Signalement.php");
    //inclusion du pied de page

    include($racine."templates/php/footer.php");
?>