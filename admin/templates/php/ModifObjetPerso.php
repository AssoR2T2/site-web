<!-- page de signalement -->

<main>
    <h2 class="center">vous être en train de modifier l'objet : <?php echo $nom ?></h2>
    <form  id="formSignal" method="post" enctype="multipart/form-data">
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