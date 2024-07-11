<?php
session_start();

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $requete = "SELECT * FROM Utilisateurs WHERE adresse_email = '$email' AND mot_de_passe = md5('$mot_de_passe')";
    $resultat = mysqli_query($connexion, $requete);

    if (mysqli_num_rows($resultat) == 1) {
        $utilisateur = mysqli_fetch_assoc($resultat);
        if($utilisateur['est_bloquer']==1){
            $_SESSION['erreur'] = 'Votre compte et bloquer contacter admin';
            header('Location: connexion.php');
        }else{
                

                $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
                $_SESSION['nom'] = $utilisateur['nom']." ".$utilisateur['prenom'];

                $_SESSION['est_administrateur'] = $utilisateur['est_administrateur'];


                header('Location: index.php');
                exit;
        }

    } else {
        $_SESSION['erreur'] = 'Email ou mot de passe incorrect';
        header('Location: connexion.php');
    }


mysqli_close($connexion);
?>