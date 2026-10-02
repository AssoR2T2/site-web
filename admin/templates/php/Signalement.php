<!-- page de signalement -->

<main>
    <form  id="formSignal" method="post" enctype="multipart/form-data">
        <!-- récupere le lien de l'image et l'affiche temporairement-->
        <div id="imgSignalement">
            
        </div>
        <button type="button" id="img">Choisir des photos</button>
        <input type="hidden" value="<?php echo $_SESSION['crsf'] ?>" name='crsf'>
        <input class="inputSignal" id="file" type="file" accept="image/*" multiple name="photo[]">
        <input class="inputSignal" id="name" type="text" placeholder="Nom" maxlength="50" name="nomObjet">
        <select class="inputSignal" id="etat" name="etat">
            <option value="perdu">Perdu</option>
            <option value="trouver">Trouver</option>
        </select>
        <input class="inputSignal" id="date" type="date" name="date">
        <input class="inputSignal" id="lieu" type="text" placeholder="lieu" maxlength="100" name="lieu">
        <textarea id="descriptionObjet" maxlength="1000" name="description"></textarea>
        <button id="submit" type="submit" name="signal">Valider</button>
    </form>
</main>