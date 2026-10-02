<!-- page d'inscription -->

<main>
<form method="post" id="FormConSign" class="flexColumn" onsubmit="return CheckSubmit(event)">
        <h2 id="TitleSign">Inscription</h2>
        <div id="NewEmail">
            <input id="Email" class="inputSignIn" placeholder="Email" type="email" name="email" maxlength="100">
            <p id="ErreurEmail" class="display erreur"></p>
        </div>
        <div id="NewPrenom">
            <input id="Prenom" class="inputSignIn InputName" placeholder="Prenom" type="text" name="prenom" maxlength="50">
            <p id="ErreurPrenom" class="display erreur"></p>
        </div>
        <div id="NewNom">
            <input id="Nom" class="inputSignIn InputName" placeholder="Nom" type="text" name="nom" maxlength="50">
            <p id="ErreurName" class="display erreur"></p>
        </div>
        <input id="NewPassword" class="inputSignIn" placeholder="Mot de passe" type="password" name="password" maxlength="50">
        <div id="NewConfPassword">
            <input id="ConfPassword" class="inputSignIn" placeholder="Confirmer le mot de passe"  type="password" name="Confpassword" maxlength="50">
            <p id="ErreurPassword" class="display erreur"></p>
        </div>
        <button id="ButtonSign" name="LoginSign" value="LoginSign" class="inputSignIn buttonInscription">S'inscrire</button>
    </form>
</main>