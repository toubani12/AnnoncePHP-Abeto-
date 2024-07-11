<?php
session_start();

if (!isset($_SESSION['id_utilisateur'])  ) {
    
    header('Location: connexion.php');
    exit;
}elseif(!$_SESSION['est_administrateur']){
    header('Location: connexion.php');
    exit;
}


$id_signalisation = $_GET['id_signalisation'];

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$requete = "DELETE FROM signaler WHERE id_signalisation = $id_signalisation";
mysqli_query($connexion, $requete);







mysqli_close($connexion);
header("location:signalisation.php");

exit;
?>