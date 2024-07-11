<?php
session_start();

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$requete = "SELECT * FROM Annonces a left join utilisateurs u on a.id_utilisateur=u.id_utilisateur ORDER BY date_creation DESC;";
$resultat = mysqli_query($connexion, $requete);

$est_connecte = isset($_SESSION['id_utilisateur']);

$est_membre = $est_connecte && !$_SESSION['est_administrateur'];

$est_administrateur = $est_connecte && $_SESSION['est_administrateur'];

include "ELEMENTS/HEADER.PHP";
mysqli_close($connexion);
?>

<body>
    <form action="#">
        <div class="input-group">
            <div class="form-outline">
                <input type="search" id="form3" class="form-control" />
                <label class="form-label" for="form1">Search</label>
                <button type="submit" ><ion-icon class="h2 btn btn-primary"  name="search-outline"></ion-icon></button>
            </div>
        </div>
    </form>
    
    <div class="afich">
        <?php while ($annonce = mysqli_fetch_assoc($resultat)) {?>
            <div class="afich1 bg-info">
                <?php  
                echo '<div class="annonce">';
                echo '<h2>' . $annonce['titre'] . '</h2>';
                echo '<div><img class="post" src="'. $annonce['image'] .'" alt=""></div>';
                echo '<p>Publié par ' . $annonce['nom'] .' '. $annonce['prenom'].' le ' . $annonce['date_creation'] . '</p>';
                echo '<div class="casebtn">';
                echo '<a class="btn btn-dark" href="annonce.php?id_annonce=' . $annonce['id_annonce'] . '">Afficher</a>';
                
                if ($est_membre && $annonce['id_utilisateur'] == $_SESSION['id_utilisateur']) {
                    echo '<a class="btn btn-danger" href="supprimer_annonce.php?id_annonce=' . $annonce['id_annonce'] . '&image=' . $annonce['image'] . '">Supprimer</a>';
                }
                
                if ($est_membre && $annonce['id_utilisateur'] != $_SESSION['id_utilisateur']) {
                    echo '<a class="btn btn-danger" href="signaler_annonce.php?id_annonce=' . $annonce['id_annonce'] . '">Signaler</a>';
                }
                
                if ($est_administrateur) {
                    echo '<a class="btn btn-danger" href="supprimer_annonce.php?id_annonce=' . $annonce['id_annonce'] . '&image=' . $annonce['image'] . '">Supprimer</a>';
                }
                
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } ?>
    </div>  

</body>
</html>
