<!-- page de la liste d'objet -->
<!-- récuperation des valeur depuis la page Recherche de control -->

<div class="ConteneurList">
    <a href="<?php echo "Objet-$idObjet-administrateur"; ?> " class="list">
        <img class="imgPresentation" src="<?php echo $image; ?>">
        <div class="PrensentationObjet">
            <h3 class="TitreObjet ObjetP"><?php echo $NomObjet; ?></h3>
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
    <a class="SupprimerObjet" href="<?php echo "?idobjetSupp=$idObjet"; ?>" >Supprimer</a>
</div>