<!-- page de signalement -->

<main>
    <form  id="formSignal" method="post">
        <!-- récupere le lien de l'image et l'affiche temporairement-->
        <input class="inputSignal" id="name" type="text" placeholder="Nom" maxlength="50" name="nomUtil">
        <input class="inputSignal" id="prenom" type="text" placeholder="Prenom" maxlength="50" name="prenomUtil">
        <input class="inputSignal" id="email" type="email" placeholder="email" maxlength="50" name="email">
        <select class="inputSignal" id="Admin" name="Admin">
            <option value="true">Ajouter en tant qu'admin</option>
            <option value="false">Enlever des administrateur</option>
        </select>
        <input class="inputSignal" id="mtp" type="text" placeholder="mot de passe" maxlength="50" name="mtp">
        <button id="submit" type="submit">Valider</button>
    </form>
</main>