<?php 
session_start();
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['est_administrateur'] != 1) {
    header('Location: connexion.php');
    exit;
    }
$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');
$REQUEST="SELECT * FROM `signaler` s  join utilisateurs u on u.id_utilisateur=s.id_utilisateur join annonces a on a.id_annonce=s.id_annonce ORDER BY s.`date_signalisation` DESC";
if(isset($_POST['cherche'])){
    $_MOT=$_POST['cherche'];
    $REQUEST="SELECT * FROM `signaler` s  join utilisateurs u on u.id_utilisateur=s.id_utilisateur join annonces a on a.id_annonce=s.id_annonce where a.titre like '%$_MOT%' or a.titre like '%$_MOT%' or s.`date_signalisation` like '%$_MOT%' or u.nom like '%$_MOT%' or u.prenom like '%$_MOT%' or s.description_signal like '%$_MOT%' ORDER BY s.`date_signalisation` DESC";}

$result=mysqli_query($connexion,$REQUEST);
$est_connecte = isset($_SESSION['id_utilisateur']);

$est_membre = $est_connecte && !$_SESSION['est_administrateur'];

$est_administrateur = $est_connecte && $_SESSION['est_administrateur'];
include'ELEMENTS/HEADER.php' ;
?>
<div class="h1 text-center text-warning">SIGNALISATIONS</div>

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
    
    
        
<div class="afich col-md-12 text-capitalize">
<?php if (mysqli_num_rows($result)>=1) { ?>
        <?php while ($signal = mysqli_fetch_assoc($result)) {?>
        <div class="afich1 col-md-3 bg-info" >
                
        <?php  
            $date = new DateTime($signal['date_creation']);
            $datee= $date->format('d-m-Y ');
            echo '<div class="signal">';
            echo '<h2>' . $signal['titre'] . '</h2>';
            echo '<p>signaler par ' . $signal['nom'] .' '. $signal['prenom'].' le ' . $datee. '</p>';
            echo '<br><p>Description:  ' . $signal['description_signal'] .'  </p>';

            echo '<div class="casebtn ">';
            ?>
        <a class="btn btn-warning" href="annonce.php?id_annonce=<?php echo $signal['id_annonce'];?>">voire l'annonce</a>
        <a class="btn btn-danger" href="Membres.php?id_annonce=<?php echo $signal['id_annonce'];?>">voire l'annonceure</a>
        <a class="btn btn-success" href="suprimer_signal.php?id_signalisation=<?php echo $signal['id_signalisation'];?>">suprimer</a>

        

        
        <?php 
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        }else{ ?> 
            <div class="alert alert-danger col-md-12"> Aucune SIGNALISATIONS !!</div>
            <?php } ?>
        

</div>
  
</body>
</html>