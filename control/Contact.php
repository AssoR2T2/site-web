<?php
/**
*   Fichier de control pour gérer les contact de l'utilisateur.
*
*   @author Walid Rémi
*   
*/
    $racine = '../'; //chemin racine du projet 
    $title = "Contact"; //Titre de la page

    //inclusion du header
    include($racine."control/Header.php");

    //inclusion la page Contact
    include($racine."/templates/php/Contact.php");

    /**
     * Récupération de l'email de l'utilisateur ou via un POST.
     * 
     * @var string $email l'email de l'utilisateur.
     */
    if($_SESSION["connecte"]) $email = $_SESSION["email"];
    else if(isset($_POST['email'])) $email = $_POST['email'];

    /**
     * Vérifie et traite les informations du formulaire via un POST et l'envoie dans une page mail.
     * 
     * @var string $subject Le sujet de l'email saisi par l'utilisateur.
     * @var string $message Le contenue du message saisie par l'utilsateur
     * @var string $header L'en-tête de l'email incluant l'adresse de l'expéditeur.
     * @throws Exception en cas de token CRSF invalide ou manquantes.
     */
    if(isset($_POST['subject']) && isset($_POST['message']) && isset($email) && isset($_POST['crsf'])){
        if($_SESSION['crsf'] == $_POST['crsf']){
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $header = "From: $email\r\n";
            mail("walid.bensellam@alumni.univ-avignon.fr", $subject, $message, $header);
        }
        else{
            echo "<p class\"center\"> erreur crsf token <p>";
        }
    }

    //inclution du footer
    include($racine."templates/php/footer.php");
?>