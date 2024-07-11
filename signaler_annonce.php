<?php
session_start();

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit;
}

$id_annonce = $_GET['id_annonce'];
if (isset($_POST['description'])) {
    $description=$_POST['description'];
$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$id_utilisateur = $_SESSION['id_utilisateur'];
$requete = "INSERT INTO signaler (id_annonce, id_utilisateur,description_signal,date_signalisation) VALUES ('$id_annonce', '$id_utilisateur','$description',CURRENT_TIMESTAMP)";
mysqli_query($connexion, $requete);

mysqli_close($connexion);

header('Location: index.php');
exit;}
$est_connecte = isset($_SESSION['id_utilisateur']);

$est_membre = $est_connecte && !$_SESSION['est_administrateur'];

$est_administrateur = $est_connecte && $_SESSION['est_administrateur'];

include "ELEMENTS/HEADER.PHP";
?>
<form action="signaler_annonce.php?id_annonce=<?php echo $id_annonce ;?>" method="POST" class=" formA form-horizontal"  >


<div class="form-group">

<label class="control-label text-light text-uppercase text-bold" for="description">Description de signalisation</label>
<div class="col-sm-10">
    <textarea name="description" class="text-light form-control bg-transparent" id="description" required></textarea>
</div>
</div>
<div class="form-group">

<div class="col-sm-10">
    <button class=" btn btn-danger" type="submit">Signaler</button>
</div>
</div>

</form>
