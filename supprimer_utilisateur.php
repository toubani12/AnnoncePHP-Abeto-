<?php
session_start();

if (!isset($_SESSION['id_utilisateur']) || $_SESSION['est_administrateur'] != 1) {
    header('Location: connexion.php');
    exit;
}

$id_utilisateur = $_GET['id_utilisateur'];

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$requete = "DELETE FROM Utilisateurs WHERE id_utilisateur = $id_utilisateur";
mysqli_query($connexion, $requete);

$requete = "DELETE FROM Annonces WHERE id_utilisateur = $id_utilisateur";
mysqli_query($connexion, $requete);

mysqli_close($connexion);

header('Location: index.php');
exit;
?>
