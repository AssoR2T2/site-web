<!-- page de connexion -->

<main>
    <form  method="post" id="FormLogin" class="flexColumn">
        <h2>Connexion</h2>
        <input type="hidden" value="<?php echo $_SESSION['crsf'] ?>" name='crsf'>
        <input class="inputSignIn" placeholder="Email" type="email" name="emailLog" maxlength="100" value="<?php echo $emailF; ?>">
        <input class="inputSignIn" placeholder="Mot de passe" type="password" name="passwordLog" maxlength="50" value="<?php echo $mdpF; ?>">
        <button type="submit" class="inputSignIn buttonInscription">Se connecter</button>
    </form>
</main>