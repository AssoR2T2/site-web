<?php
    $racine = '../';
    $title = "FAQ";

        /**
    *   Fichier de control qui permet d'afficher la FAQ.
    *
    *   @author Walid Rémi
    */
    include($racine."control/Header.php");

    //ouvre la page FAQ
    include($racine."templates/php/FAQ.php");

    include($racine."templates/php/footer.php");
?>