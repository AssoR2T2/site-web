
<main>
    <h2 class="center">Modification de vos informations</h2>
    <form  id="formSignalProfile" method="post">
        <input type="hidden" value="<?php echo $_SESSION['crsf'] ?>" name='crsf'>
        <input class="inputSignal" id="nameUtil" type="text" placeholder="Nom" maxlength="50" name="nomUtil">
        <input class="inputSignal" id="prenomUtil" type="text" placeholder="Prenom" maxlength="50" name="prenomUtil">
        <input class="inputSignal" id="emailUtil" type="email" placeholder="email" maxlength="50" name="email">
        <input class="inputSignal" id="mtpUtil" type="password" placeholder="mot de passe" maxlength="50" name="mtp">
        <button id="submitUtil" type="submit">Valider</button>
    </form>
</main>