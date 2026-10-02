<!-- page de la liste d'objet -->
<!-- récuperation des valeur depuis la page Recherche de control -->

<a href="<?php echo "Objet-$idObjet-administrateur"; ?>" class="list">
    
    <img class="imgPresentation" src="<?php echo $image; ?>">
    <div class="PrensentationObjet">
        <h3 class="TitreObjet ObjetP"><?php echo $NomObjet1; ?></h3>
        <p class="Etat"><?php echo $Etat; ?></p>
        <div class="DateObjet">
            <p class="ObjetP">date</p>
            <p class="ObjetP"><?php echo $date; ?></p>
        </div>
        <div class="LieuObjet">
            <p class="ObjetP">lieu</p>
            <p class="ObjetP"><?php echo $lieu; ?></p>
        </div>
        <p class="Auteur ObjetP"><?php echo $auteur; ?></p>
    </div>
</a>

<a href="<?php echo "Modification_de_Objet-$idObjet-$NomObjet-administrateur" ?>" class="buttonOnObjet">Modifier</a>