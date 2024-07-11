<?php 
session_start();
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['est_administrateur'] != 1) {
    header('Location: connexion.php');
    exit;
    }
$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

if (isset($_GET['id_annonce'])){
    $cherche=$_GET['id_annonce'];
    $REQUEST="SELECT * FROM `utilisateurs` u join annonces a on a.id_utilisateur=u.id_utilisateur  where id_annonce=' $cherche'";

}elseif(isset($_POST['cherche'])){
    $cherche=$_POST['cherche'];
    $REQUEST="SELECT * FROM `utilisateurs` where est_administrateur is null and (nom like '%$cherche%' or adresse_email like '%$cherche%' or prenom like '%$cherche%' or numero_de_telephone like '%$cherche%' or adresse_postale like '%$cherche%') ORDER BY `utilisateurs`.`nom` ASC";

}else{
    $REQUEST="SELECT * FROM `utilisateurs` where est_administrateur is null ORDER BY `utilisateurs`.`nom` ASC";

}
$result=mysqli_query($connexion,$REQUEST);
$est_connecte = isset($_SESSION['id_utilisateur']);

$est_membre = $est_connecte && !$_SESSION['est_administrateur'];

$est_administrateur = $est_connecte && $_SESSION['est_administrateur'];
include'ELEMENTS/HEADER.php' ;
?>
<div class="h1 text-center text-warning">Membres</div>

<form class="form-inline d-flex justify-content-center md-form form-sm mt-0" action="#" method="POST">
        <input class="form-control form-control-sm ml-4 w-75" type="text" placeholder="Rechercher" aria-label="Search" name="cherche">
        
        <div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search "></i>
                Chercher
            </button>
        </div>

    </form> 
<br><br>
    
    
        
<div class="afich col-md-12 text-capitalize ">
<?php if (mysqli_num_rows($result)>=1) { ?>
        <?php while ($user = mysqli_fetch_assoc($result)) {?>
            <?php if($user['est_bloquer']==1 ){
                echo '<div class="afich1 col-md-3 bg-danger " >';
            }else{
                echo '<div class="afich1 col-md-3 bg-info " >';
 
            }
            ?>
            
                
        <?php  

            echo '<div class="user">';
            
                echo '<h3 class="h3 "> ' . $user['nom'] .' '. $user['prenom'].'</h3>';
                echo '<h3 class="h5 "> ' . $user['numero_de_telephone'] .'</h3>';
                echo '<h3 class="h6 text-lowercase"> ' . $user['adresse_email'] .'</h3>';
            echo '</div>';
            echo '<div class="casebtn">';
            ?>
        <a class="btn btn-success" href="index.php?cherche=<?php echo $user['id_utilisateur'];?>">voire ses annonce</a>
        <?php if($user['est_bloquer']==1 ){
                echo '<a class="btn btn-info" href="debloquer_utilisateur.php?id_utilisateur='.$user['id_utilisateur'].'">Debloquer</a>';

            }else{
                echo '<a class="btn btn-danger" href="bloquer_utilisateur.php?id_utilisateur='.$user['id_utilisateur'].'">Bloquer</a>';
 
            }
            ?>
        

        

        
        <?php 
            
            echo '</div>';
            echo '</div>';
        }
        }else{ ?> 
        <div class="alert alert-danger col-md-12"> Aucun Membres!!</div>
        <?php } ?>
        

</div>

</body>
</html>