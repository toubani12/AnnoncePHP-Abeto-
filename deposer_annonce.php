 <?php
session_start();

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit;
}

if (isset($_POST['titre'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $id_utilisateur = $_SESSION['id_utilisateur'];
    
    $connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');
    $upload_dir = "uploads/";
    
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $new_file_name = uniqid() . '_' . date('d-m-Y-H-i-s') . '.' . $extension;
    $file_tmp_name = $_FILES['file']['tmp_name'];
    if (move_uploaded_file($file_tmp_name, $upload_dir . $new_file_name)) {
        header("location:index.php");
    } else {
        echo "Une erreur est survenue lors du téléchargement du fichier.";
    }
    

    $requete = "INSERT INTO Annonces (titre, description,date_creation, image,prix, id_utilisateur) VALUES ('$titre', '$description',CURRENT_TIMESTAMP,'uploads/$new_file_name','$prix', '$id_utilisateur')";
    mysqli_query($connexion, $requete);

    mysqli_close($connexion);
    


   
    exit;
}
$est_connecte = isset($_SESSION['id_utilisateur']);

$est_membre = $est_connecte && !$_SESSION['est_administrateur'];

$est_administrateur = $est_connecte && $_SESSION['est_administrateur'];

include "ELEMENTS/HEADER.PHP";
?>



<form method="post" enctype="multipart/form-data" class=" formA form-horizontal">
    <h2 class=" justify-center">Déposer une annonce</h2>
    <div class="form-group">
        <label class="control-label col-sm-2" for="titre">Titre :</label>
        <div class="col-sm-10">
            <input type="text" class="text-light form-control bg-transparent" name="titre" required>
        </div>
    </div>
    <div class="form-group">

        <label class="control-label col-sm-2" for="description">Description:</label>
        <div class="col-sm-10">
            <textarea name="description" class="text-light form-control bg-transparent" id="description" required></textarea>
        </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" >image :</label>

        <div class="col-sm-10">
            <input type="file" class="text-success form-control btn btn-success bg-transparent" name="file"  accept="image/*">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="prix">Prix :</label>
        <div class="col-sm-10">
             <input type="number"  class="text-light  form-control bg-transparent" name="prix" required>
        </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <br>
            <button type="submit" class="form-control btn btn-success" >Déposer</button>
        </div>
    </div>
</form>
<footer>
    <?php echo $_SESSION['admin_info']?>
</footer>
</body>
</html>
