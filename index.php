<?php
session_start();

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$admin = mysqli_query($connexion, "SELECT * FROM utilisateurs where  est_administrateur=1");
if(mysqli_num_rows($admin)==0){header("location:admin.php");}else{
    $info_admin=mysqli_fetch_assoc($admin);
    $_SESSION['admin_info']="pour tout information contacter nous :<br> Telephone :".$info_admin['numero_de_telephone'].' <br> Email:'.$info_admin['adresse_email'];}

if(isset($_POST['cherche'])){
    $requete = "SELECT * FROM Annonces a left join utilisateurs u on a.id_utilisateur=u.id_utilisateur where a.titre like '%".$_POST['cherche']."%' and u.est_bloquer is null  ORDER BY date_creation DESC;";
   
}elseif(isset($_GET['cherche'])){
    $requete = "SELECT * FROM Annonces a left join utilisateurs u on a.id_utilisateur=u.id_utilisateur where u.id_utilisateur like '%".$_GET['cherche']."%' and u.est_bloquer is null   ORDER BY date_creation DESC;";
   
}else{
    $requete = "SELECT * FROM Annonces a left join utilisateurs u on a.id_utilisateur=u.id_utilisateur where u.est_bloquer is null ORDER BY date_creation DESC;";
}

$resultat = mysqli_query($connexion, $requete);

$est_connecte = isset($_SESSION['id_utilisateur']);

$est_membre = $est_connecte && !$_SESSION['est_administrateur'];

$est_administrateur = $est_connecte && $_SESSION['est_administrateur'];


mysqli_close($connexion);

include "ELEMENTS/HEADER.PHP";

?>

<main class="flex-column justify-content-between">



    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0" action="#" method="POST">
        <input class="form-control form-control-sm ml-4 w-50" type="text" placeholder="Rechercher" aria-label="Search" name="cherche">
        
        <div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search "></i>
                Chercher
            </button>
        </div>

    </form> 
<br><br>
    
    
        
<div class="afich d-flex justify-content-center col-md-12 text-capitalize ">
<?php if (mysqli_num_rows($resultat)>=1) { ?>
        <?php 
            while ($annonce = mysqli_fetch_assoc($resultat)) { 
                
                ?>
        <div class="afich1 col-md-3 " >
                
        <?php  
            $date = new DateTime($annonce['date_creation']);
            $datee= $date->format('d-m-Y ');
            echo '<div class="annonce">';
            echo '<h2 class="tit">' . $annonce['titre'] . '</h2>';
            echo '<div><img class="post" src="'. $annonce['image'] .'" alt=""></div>';
            echo '<div>Publié par ' . $annonce['nom'] .' '. $annonce['prenom'].'</div><div> le ' . $datee. '</div>';
            echo '<div class="casebtn d-flex flex-direction-row justify-content-center">';
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
        }
        }else{ ?>
        <div class="alert alert-danger col-md-12"> PAS D'ANNONCES</div>
        
        <?php } ?>

        

</div>  
<footer class=" d-flex-row row-md-12  text-center text-uppercase text-light">
    <div class="row-md-5 ">
        <?php echo $_SESSION['admin_info']?>
    </div>
    <div class="row-md-5 ">
    
        <p class="text-uppercase">crée par badr eddine toubani</p>
    </div>
</footer>
</main>
</body>

</html>
