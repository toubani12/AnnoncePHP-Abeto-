<?php
session_start();
if (!isset($_GET['id_annonce'])) {
    header('Location: index.php');
    exit();
}

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$id_annonce = $_GET['id_annonce'];
$requete = "SELECT * FROM Annonces a left join utilisateurs u on a.id_utilisateur=u.id_utilisateur WHERE id_annonce = " . $id_annonce;
$resultat = mysqli_query($connexion, $requete);

if (mysqli_num_rows($resultat) == 0) {
    header('Location: index.php');
    exit();
}

$annonce = mysqli_fetch_assoc($resultat);

$est_connecte = isset($_SESSION['id_utilisateur']);
if ($est_connecte){ 
$est_membre = $est_connecte && !$_SESSION['est_administrateur'];

$est_administrateur = $est_connecte && $_SESSION['est_administrateur'];

$est_auteur_ou_administrateur = $annonce['id_utilisateur'] == $_SESSION['id_utilisateur'] || $est_administrateur;}else{
    $est_auteur_ou_administrateur=false;
}

$date = new DateTime($annonce['date_creation']);
$datee= $date->format('d-m-Y ');

function afficher_details_annonce($annonce, $est_auteur_ou_administrateur) {
    echo '<h2>' . $annonce['titre'] . '</h2>';
    echo '<div><img class="col-5" src="'. $annonce['image'] .'" alt=""></div>';
   echo"<div class='text-uppercase'>Déscripton: ";
    echo '<p>' . $annonce['description'] . '</p></div>';
    echo '<p class="h2">Prix  : ' . $annonce['prix'] . '</p>';

    if ($est_auteur_ou_administrateur) {
        echo '<div><a class="btn btn-danger" href="supprimer_annonce.php?id_annonce=' . $annonce['id_annonce'] . '">Supprimer</a></div>';
    }
}

include "ELEMENTS/HEADER.PHP";
mysqli_close($connexion);
?>

<div class="container  row">
    <div class="text-light text-uppercase col-md-9">
        <?php afficher_details_annonce($annonce, $est_auteur_ou_administrateur); ?>
    </div>
    <div class="text-light text-uppercase col-md-3">
        <br><br>
     <?php     echo '<p>Publié par ' . $annonce['nom'] ." ". $annonce['prenom'] . ' <br>le ' . $datee . '</p>'; ?>

       
       <div>telephone:</div> 
        <p><?php echo $annonce['numero_de_telephone']; ?></p>
        <div>Adresse:</div>
        <p><?php echo $annonce['adresse_postale']; ?></p>

        <?php 
        if ($est_connecte){ 
        if ($est_administrateur) {
            ?>
            <div>
            <?php
            echo '<a class="btn btn-warning" href="Membres.php?id_annonce='. $annonce['id_annonce'].'">voire annonceure</a>';
            

           
            }}
        ?></div>
    </div>
</div>
<footer class=" d-flex-row row-md-12  text-center text-uppercase text-light">
    <div class="row-md-5 ">
        <?php echo $_SESSION['admin_info']?>
    </div>
    <div class="row-md-5 ">
    
        <p class="text-uppercase">crée par badr eddine toubani</p>
    </div>
</footer>
    
</body>
</html>
