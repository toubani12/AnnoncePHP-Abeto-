<?php

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse_email = $_POST['adresse_email'];
    $adresse_postale = $_POST['adresse_postale'];
    $numero_de_telephone = $_POST['numero_de_telephone'];
    $mot_de_passe = $_POST['mot_de_passe'];

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');
if(!$connexion) echo 'error 407';
    $requete ="INSERT INTO Utilisateurs (nom, prenom, adresse_email, adresse_postale, numero_de_telephone, mot_de_passe) VALUES ('$nom', '$prenom', '$adresse_email', '$adresse_postale', '$numero_de_telephone',md5( '$mot_de_passe'))";
if(mysqli_query($connexion, $requete)){
    mysqli_close($connexion);

    header('Location: index.php');
    exit;
}else{
    echo "error 408";
}




?>