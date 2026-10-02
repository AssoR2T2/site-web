<main>
    <div class="list">
        <table>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>mot de passe</th>
                <th>Admin</th>
                <th>Banni</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php
            foreach($ListeUtilisateur as $Utilisateurs){
                echo "<tr>";
                    $idutilisateur = $Utilisateurs['idutilisateur'];
                    foreach($Utilisateurs as $Utilisateur){
                        echo "<td>".($Utilisateur === false ? "false" : ($Utilisateur === true ? "true" : $Utilisateur))."</td>";
                    }
                    echo "<td><a href= \"?page=supprimeUtil&id=$idutilisateur\">Supprimer</a></td>";
                    echo "<td>".($Utilisateurs['banni'] === false ? "<a href=\"?page=banni&id=$idutilisateur\">Bannir</a>" : "
                    <a href=\"?page=banni&id=$idutilisateur\">Débannir</a>")."</td>";
                    echo "<td><a href=\"Modification-Utilisateurs-administrateur-$idutilisateur\">Modifier</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</main>