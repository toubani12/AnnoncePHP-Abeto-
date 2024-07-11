<?php
session_start();

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit;
}


$id_annonce = $_GET['id_annonce'];
$image = $_GET['image'];
$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$requete = "DELETE FROM Annonces WHERE id_annonce = $id_annonce";
mysqli_query($connexion, $requete);




unlink($image);








mysqli_close($connexion);
header("location:index.php");

exit;
?>
