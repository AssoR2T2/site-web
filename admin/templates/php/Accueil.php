<!-- page de d'accueil -->

<main id="Accueil">
    <!--bloc  de d'inscription -->
    <form method="post" id="inscriptionFast" class="flexColumn" onsubmit="return CheckSubmit2(event)">
        <?php
        if($_SESSION["connecte"] == false){
            echo "<div class=\"titre\">Retrouver vos biens en vous inscrivant maintenant!!!</div>
            <input id=\"Email2\" class=\"inputSignIn\" placeholder=\"Email\" type=\"email\" name=\"email\">
            <p id=\"ErreurEmail2\" class=\"display erreur\"></p>
            <input id=\"nom2\" class=\"inputSignIn\" placeholder=\"Nom\" type=\"text\" name=\"nom\">
            <p id=\"ErreurNom2\" class=\"display erreur\"></p>
            <input id=\"prenom2\" class=\"inputSignIn\" placeholder=\"Prenom\" type=\"text\" name=\"prenom\">
            <p id=\"ErreurPrenom2\" class=\"display erreur\"></p>
            <input id=\"password2\" class=\"inputSignIn\" placeholder=\"Mot de passe\" type=\"password\" name=\"password\">
            <input id=\"ConfPassword2\" class=\"inputSignIn\" placeholder=\"Confirmer le mot de passe\"  type=\"password\" name=\"Confpassword\">
            <p id=\"ErreurPassword2\" class=\"display erreur\"></p>
            <button name=\"SignIn\" class=\"inputSignIn buttonInscription\">S'inscrire</button>";
        }
        ?>
    </form>

    <!-- bloc de présentation -->
    <div id="presentation">
        <h2>Bienvenue !!!</h2>
        TrackMyStuff vous aide à retrouver vos objets perdus en toute simplicité ! 
        Signalez une perte ou une trouvaille, recherchez des objets et contactez directement leur propriétaire. 
        Une solution rapide et gratuite pour faciliter la restitution des objets égarés.
    </div>

    <!-- bouton de signalement -->
    <div id="buttonSignalFast">
        <a href="<?php echo "Signalement-administrateur"; ?>" class="SignalButton">Signalez</a>
    </div>
</main>