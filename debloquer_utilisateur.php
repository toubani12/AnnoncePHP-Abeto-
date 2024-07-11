<?php
session_start();

if (!isset($_SESSION['id_utilisateur']) || $_SESSION['est_administrateur'] != 1) {
header('Location: connexion.php');
exit;
}

$id_utilisateur = $_GET['id_utilisateur'];

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$requete = "UPDATE utilisateurs SET est_bloquer = null WHERE id_utilisateur =' $id_utilisateur'";
mysqli_query($connexion, $requete);

mysqli_close($connexion);

header('Location: Membres.php');
exit;
?>