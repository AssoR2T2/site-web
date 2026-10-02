<!-- page de la fiche objet -->
<!-- prend les information de l'objet depuis Objet.php de control -->

<main>
    <div class="FicheObjet">
    <div id="imgContainer">
        <?php
        foreach($image as $affImage){
            echo "<img class=\"imageObjet\" src=\"$affImage\">";
        }
        ?>
        </div>
        <div id="description"><?php echo $description; ?></div>
        <a id="modif" href="<?php echo "Modification_de_Objet-$id-$NomObjet1-administrateur" ?>">Modifier</a>
        <div id="InfAuteur">
            <h5 class="NoMargin">Auteur : <?php echo $auteur; ?></h5>
            <a class="center" id="Bannir" href="<?php echo $racine."control/Confirmation.php?page=banni&id=$idutilisateur"; ?>">Bannir l'auteur</a>
        </div>
        <h3 id="NomObjet"><?php echo $NomObjet; ?></h3>
        <p id="InfObjet"><?php echo $Etat.".".$lieu.".".$date; ?></p>
    </div>
</main>