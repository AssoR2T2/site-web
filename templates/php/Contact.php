<!-- page de contact -->

<main id="main-back">
    <form method="post" id="blockcontact"> 
        <h2 >Contact</h2>
            <?php if($_SESSION["connecte"] == false){
                echo "<p>Entrez votre email.</p>
                <input class=\"contacter\" type=\"text\" id=\"monemail\" name=\"name\" maxlength=\"50\">";
            }
            ?>
       
            <p>Entrez le sujet du mail.</p>
            <input class="contacter" type="text" id="sujet" name="subject" maxlength="50">
            <input type="hidden" value="<?php echo $_SESSION['crsf'] ?>" name='crsf'>
            <textarea class="contacter" type="intput" id="message" placeholder="Ecrivez votre mail." name="message" maxlength="1000"></textarea>

            <button type="submit" class="buttonInscription">Envoyer</button>
    </form>
   
</main>